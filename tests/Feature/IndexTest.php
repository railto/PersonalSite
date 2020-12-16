<?php

namespace Tests\Feature;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function indexPageLoads()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Hi there,');
        $response->assertSee("I'm Mark", false);
    }

    /** @test */
    public function indexPageLoadsRecentArticles()
    {
        $articles = Article::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Hi there,');
        $response->assertSee("I'm Mark", false);
        $response->assertSee($articles[0]->title);
        $response->assertSee($articles[1]->title);
        $response->assertSee($articles[2]->title);
    }

    /** @test */
    public function indexPageLoadsRecentArticlesExceptUnpublished()
    {
        $article = Article::factory()->create();
        $unpublishedArticle = Article::factory()->unpublished()->create();
        $futurePublishedArticle = Article::factory()->create([
            'published_at' => Carbon::now()->addDays(2),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Hi there,');
        $response->assertSee("I'm Mark", false);
        $response->assertSee($article->title);
        $response->assertDontSee($unpublishedArticle->title);
        $response->assertDontSee($futurePublishedArticle);
    }
}
