<?php


namespace Feature;


use App\Models\Article;
use App\Models\User;
use Tests\TestCase;

class ViewArticleTest extends TestCase
{
    /** @test */
    public function it_displays_a_published_article()
    {
        $article = Article::factory()->create();

        $response = $this->get($article->path());

        $response->assertSee($article->title);
        $response->assertSee($article->published_at->format('jS F Y'));
    }

    /** @test */
    public function a_guest_can_not_view_an_unpublished_article()
    {
        $unpublishedArticle = Article::factory()->unpublished()->create();

        $response = $this->get($unpublishedArticle->path());

        $response->assertStatus(404);
        $response->assertDontSee($unpublishedArticle->title);
    }

    /** @test */
    public function an_authenticated_user_can_view_an_unpublished_article()
    {
        $user = User::factory()->create();
        $unpublishedArticle = Article::factory()->unpublished()->create();

        $response = $this->actingAs($user)->get($unpublishedArticle->path());

        $response->assertStatus(200);
        $response->assertSee($unpublishedArticle->title);
    }
}
