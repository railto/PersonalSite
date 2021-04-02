<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Abraham\TwitterOAuth\TwitterOAuth;

class UpdateTwitterFollowList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates twitter follow list';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $consumer_key = config('app.twitter.consumer_key');
        $consumer_secret = config('app.twitter.consumer_secret');
        $access_token = config('app.twitter.access_token');
        $access_token_secret = config('app.twitter.access_token_secret');
        $user_id = config('app.twitter.user_id');
        $list = config('app.twitter.list');
        $connection = new TwitterOAuth(
            $consumer_key,
            $consumer_secret,
            $access_token,
            $access_token_secret
        );

        $new_users = [];
        $finished = false;
        $raw_statuses = [];
        $conditions = [
            'user_id' => $user_id,
            'include_rts' => true,
            'exclude_replies' => false,
            'count' => 3200
        ];
        $cutoff_date = strtotime("1 month ago");
        $max_id = 0;

        $this->info("Going through the timeline...");

        while (!$finished) {
            $data = $connection->get(
                "statuses/user_timeline",
                $conditions
            );

            // Loop through and grab the oldest ID
            foreach ($data as $status) {
                if (strtotime($status->created_at) >= $cutoff_date) {
                    $raw_statuses[] = $status;
                    $max_id = $status->id;
                } else {
                    $finished = true;
                    break;
                }
            }
            $tweet_count = count($raw_statuses);

            $this->info("{$tweet_count} tweets");

            if (isset($conditions['max_id'])) {
                if ($conditions['max_id'] == $max_id) {
                    $finished = true;
                }
            }

            $conditions['max_id'] = $max_id;
        }

        // First, eliminate any tweets that are older than a month
        $this->info("Grabbing interaction tweets...");

        $statuses = array_filter($raw_statuses, function ($status) {
            if ($status->in_reply_to_user_id) {
                return true;
            }

            if (isset($status->retweeted_status)) {
                return true;
            }

            if (isset($status->quoted_status)) {
                return true;
            }

            return false;
        });

        $this->info("Building list of new users you interacted with...");

        foreach ($statuses as $status) {
            if (isset($status->in_reply_to_user_id, $new_users)) {
                $new_users[] = $status->in_reply_to_user_id;
            } elseif (isset($status->retweeted_status)) {
                $new_users[] = $status->retweeted_status->user->id;
            } elseif (isset($status->quoted_status)) {
                $new_users[] = $status->quoted_status->user->id;
            } elseif (isset($status->entities)) {
                foreach ($status->entities->user_mentions as $mention) {
                    if (isset($mention->id) && !in_array($mention->id, $new_users)) {
                        $new_users[] = $mention->id;
                    }
                }
            }
        }

        // Grab everyone we favourited
        $this->info("Grabbing favorites...");
        $finished = false;
        $max_id = 0;
        $conditions = ['user_id' => $user_id, 'count' => 200];
        $favorites = [];

        while (!$finished) {
            $data = $connection->get(
                "favorites/list",
                $conditions
            );

            // Loop through and grab the oldest ID
            foreach ($data as $favorite) {
                if (strtotime($favorite->created_at) >= $cutoff_date) {
                    $favorites[] = $favorite;
                    $max_id = $favorite->id;
                } else {
                    $finished = true;
                    break;
                }
            }

            if (isset($conditions['max_id'])) {
                if ($conditions['max_id'] == $max_id) {
                    $finished = true;
                }
            }

            $conditions['max_id'] = $max_id;
        }

        foreach ($favorites as $favorite) {
            $new_users[] = $favorite->user->id;
        }

        // Get current users on our list
        $this->info("Grabbing users currently on our cycle list...");
        $members = $connection->get(
            "lists/members",
            ['list_id' => $list, 'count' => 5000]
        );

        $users = $members->users;
        $current_users = [];

        foreach ($users as $user) {
            $current_users[] = $user->id;
        }

        $this->info("Currently have ".count($current_users)." on the cycle list");
        // Filter out all the duplicates from our array
        $new_users = array_unique($new_users);

        // Generate our list of users to add to the list and ones to remove
        $users_to_add = array_diff($new_users, $current_users);
        $users_to_remove = array_diff($current_users, $new_users);

        if (!empty($users_to_remove)) {
            // There is a limit that we can only add 100 users at a time
            $offset = 0;
            $finished = false;

            while (!$finished) {
                $user_slice = array_slice($users_to_remove, $offset, 100);
                $response = $connection->post(
                    "lists/members/destroy_all",
                    ['list_id' => $list, 'user_id' => implode(",", $user_slice)]
                );

                if ($connection->getLastHttpCode() !== 200) {
                    $this->info("ERROR while trying to remove users from the cycle list");
                    print_r($response);
                    exit();
                }

                // Look to see if we have more records to process
                if (count($users_to_remove) > ($offset + 100)) {
                    $offset = $offset + 100;
                } else {
                    $finished = true;
                }

                $this->info("Removed ".count($users_to_remove)." accounts you didn't interact with");
            }
        }

        // Next, add people who aren't already in the lists
        if (!empty($users_to_add)) {
            // There is a limit that you can only add 100 users at a time
            $offset = 0;
            $finished = false;
            while (!$finished) {
                $user_slice = array_slice($users_to_add, $offset, 100);
                $response = $connection->post(
                    "lists/members/create_all",
                    ['list_id' => $list, 'user_id' => implode(",", $user_slice)]
                );

                if ($connection->getLastHttpCode() !== 200) {
                    $this->info("ERROR while trying to add users to the cycle list");
                    print_r($response);
                    exit();
                }

                // Look to see if we have more records to process
                if (count($users_to_add) > ($offset + 100)) {
                    $offset = $offset + 100;
                } else {
                    $finished = true;
                }
            }
            $this->info("Added ".count($users_to_add)." to the cycle list");
        }

        return 0;
    }
}
