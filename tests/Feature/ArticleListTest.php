<?php

namespace Tests\Feature;

use App\Models\Article;
use Tests\TestCase;

class ArticleListTest extends TestCase
{
    /** @test */
    public function it_displays_a_list_of_published_articles()
    {
        $articles = Article::factory()->count(8)->create();

        $response = $this->get('/blog');

        $response->assertSee('Blog Articles');
        $response->assertSee($articles[0]->title);
        $response->assertSee($articles[2]->title);
        $response->assertSee($articles[5]->title);
    }

    /** @test */
    public function it_does_not_display_unpublished_blog_post_in_list()
    {
        $articles = Article::factory()->count(5)->create();
        $unpublishedArticle = Article::factory()->unpublished()->create();

        $response = $this->get('/blog');

        $response->assertSee('Blog Articles');
        $response->assertSee($articles[0]->title);
        $response->assertSee($articles[2]->title);
        $response->assertDontSee($unpublishedArticle->title);
    }

    /** @test */
    public function it_shows_pagination_when_more_than_10_articles()
    {
        $articles = Article::factory()->count(13)->create();

        $response = $this->get('/blog');

        $response->assertSee('Blog Articles');
        $response->assertSee('Newer');
        $response->assertSee('Older');
    }
}
