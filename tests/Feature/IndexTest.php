<?php

namespace Tests\Feature;

use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function index_page_loads()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Hi there,');
        $response->assertSee("I'm Mark", false);
    }
}
