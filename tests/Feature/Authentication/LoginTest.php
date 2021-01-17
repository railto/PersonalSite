<?php

namespace Tests\Feature\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_view_login_page()
    {
        $response = $this->get('/login');

        $response->assertSee('Email Address');
        $response->assertSee('Password');
    }

    /** @test */
    public function authenticated_user_can_not_view_login_page()
    {
        $user = User::factory()->create();
        $this->followRedirects = true;

        $response = $this->actingAs($user)->get('/login');

        $response->assertLocation('/');
        $response->assertSee('Hi there,');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function redirects_to_index_on_login()
    {
        $user = User::factory()->create(['email' => 'user@test.com', 'password' => bcrypt('test1234')]);
        $this->followRedirects = true;

        $response = $this->post('/login', [
            'email' => 'user@test.com',
            'password' => 'test1234',
        ]);

        $response->assertLocation('/');
        $response->assertSee('Hi there,');
        $this->assertAuthenticatedAs($user);
    }
}
