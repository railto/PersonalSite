<?php

namespace Database\Factories;

use App\Models\Article;
use Cocur\Slugify\Slugify;
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
    public function definition()
    {
        $title = $this->faker->sentence;
        $slugify = new Slugify();

        return [
            'title' => $title,
            'slug' => $slugify->slugify($title),
            'content' => $this->faker->sentences(5, true),
            'published_at' => $this->faker->dateTimeBetween('-2 years', '-1 day'),
        ];
    }

    public function unpublished()
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
