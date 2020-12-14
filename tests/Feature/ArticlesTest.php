<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function blogPageShowsArticlesList()
    {
        $article1 = Article::factory()->create();
        $article2 = Article::factory()->create();

        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee($article1->title);
        $response->assertSee($article2->title);
    }

    /** @test */
    public function blogPageShowsOnlyPublishedArticles()
    {
        $publishedArticles = Article::factory()->count(2)->create();
        $unpublishedArticle = Article::factory()->unpublished()->create();
        $advancedDatePublishedArticle = Article::factory()->create(
            [
                'published_at' => Carbon::now()->addDay(),
            ]
        );

        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee($publishedArticles[0]->title);
        $response->assertSee($publishedArticles[1]->title);
        $response->assertDontSee($unpublishedArticle->title);
        $response->assertDontSee($advancedDatePublishedArticle->title);
    }
}
