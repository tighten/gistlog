<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_cannot_do_super_secret_stuff()
    {
        $response = $this->get(route('post.starcount', ['12345']));

        $response->assertRedirect(route('login'));
    }
}
