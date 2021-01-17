<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
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
        $advancedDatePublishedArticle = Article::factory()->create([
            'published_at' => Carbon::now()->addDay(),
        ]);

        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee($publishedArticles[0]->title);
        $response->assertSee($publishedArticles[1]->title);
        $response->assertDontSee($unpublishedArticle->title);
        $response->assertDontSee($advancedDatePublishedArticle->title);
    }

    /** @test */
    public function blogPageIsPaginated()
    {
        $articles = Article::factory()->count(15)->create();
        $newArticle = Article::factory()->create([
            'published_at' => Carbon::now()->subDays(1),
        ]);

        $oldArticle = Article::factory()->create([
            'published_at' => Carbon::now()->subYears(3),
        ]);

        $response = $this->get('/blog');

        $response->assertStatus(200);
        $response->assertSee($newArticle->title);
        $response->assertDontSee($oldArticle->title);

        $response2 = $this->get('/blog?page=2');
        $response2->assertDontSee($newArticle->title);
        $response2->assertSee($oldArticle->title);

    }

    /** @test */
    public function aVisitorCanViewAPublishedPost()
    {
        $article = Article::factory()->create();

        $response = $this->get("/blog/{$article->slug}");

        $response->assertStatus(200);
        $response->assertSee($article->title);
        $response->assertSee(Carbon::parse($article->published_at)->format('jS F Y'), true);
        $response->assertSee($article->content);
    }

    /** @test */
    public function aVisitorGets404WhenTryingToViewPostThatDoesNotExist()
    {
        $response = $this->get('/blog/this-article-does-not-exist');

        $response->assertStatus(404);
    }

    /** @test */
    public function aGuestCanNotViewUnPublishedPost()
    {
        $article = Article::factory()->unpublished()->create();

        $response = $this->get("/blog/{$article->slug}");

        $response->assertStatus(404);
        $response->assertDontSee($article->title);
        $response->assertDontSee(Carbon::parse($article->published_at)->format('jS F Y'), true);
        $response->assertDontSee($article->content);
    }

    /** @test */
    public function aGuestCanNotViewAPostWithFuturePublishedDate()
    {
        $article = Article::factory()->create([
            'published_at' => Carbon::now()->addDays(2),
        ]);

        $response = $this->get("/blog/{$article->slug}");

        $response->assertStatus(404);
        $response->assertDontSee($article->title);
        $response->assertDontSee(Carbon::parse($article->published_at)->format('jS F Y'), true);
        $response->assertDontSee($article->content);
    }

    /** @test */
    public function an_authenticated_user_can_view_an_unpublished_article()
    {
        $article = Article::factory()->unpublished()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get("/blog/{$article->slug}");

        $response->assertStatus(200);
        $response->assertSee($article->title);
        $response->assertSee(Carbon::parse($article->published_at)->format('jS F Y'), true);
        $response->assertSee($article->content);
    }
}
