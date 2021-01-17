<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Article extends Model implements Feedable
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title', 'slug', 'published_at', 'content',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => '/blog/' . $this->slug,
            'title' => $this->title,
            'updated' => Carbon::parse($this->published_at),
            'summary' => $this->title,
            'author' => 'Mark Railton',
            'link' => '/blog/' . $this->slug,
        ]);
    }

    public function getFeedItems()
    {
        return Article::where('published_at', '<', date("Y-m-d H:i:s"))->orderBy('published_at', 'desc')->get();
    }
}
