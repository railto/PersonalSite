<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $user = User::find(1);
        if (!$user) {
            $user = User::factory()->create();
        }

        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->sentences(5, true),
            'published_at' => $this->faker->dateTimeBetween('-2 years', '-1 day'),
            'user_id' => $user->id,
        ];
    }

    public function unpublished(): ArticleFactory
    {
        return $this->state(
            function (array $attributes) {
                return [
                    'published_at' => null,
                ];
            }
        );
    }
}
