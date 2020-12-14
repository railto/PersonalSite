<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
