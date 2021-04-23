<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads()
    {
        $publishedArticle = Article::factory()->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Mark Railton');
        $response->assertSee($publishedArticle->title);
    }

    /** @test */
    public function it_doesnt_show_unpublished_article_on_index()
    {
        $unpublishedArticle = Article::factory()->unpublished()->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Mark Railton');
        $response->assertDontSee($unpublishedArticle->title);
    }
}
