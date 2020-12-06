<?php

namespace Tests\Feature;

use Tests\TestCase;

class UsesTest extends TestCase
{
    /** @test */
    public function uses_pages_loads()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/uses');

        $response->assertStatus(200);
        $response->assertSee('My Setup');
        $response->assertSee('Laptop: MacBook Pro 2020 13" with macOS Catalina', false);
    }
}
