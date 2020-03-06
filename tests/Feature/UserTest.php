<?php

// use App\Gists\Comment;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_view_user_edit_form()
    {
        $response = $this->be(User::make())->get(route('users.edit'));

        $response->assertSuccessful();
        $response->assertSee('Homepage URL:');
    }

    /** @test */
    function cant_view_user_edit_form_if_not_logged_in()
    {
        $response = $this->get(route('users.edit'));

        $response->assertRedirect('/');
    }

    /** @test */
    function can_update_user_details()
    {
        $user = User::create([
            'avatar' => 'foo',
            'github_id' => 123,
            'token' => 'bar',
        ]);

        $response = $this->be($user)->post(route('users.update'), [
            'homepage' => 'https://google.com'
        ]);

        $response->assertRedirect(route('users.update'));
        $this->assertSame('https://google.com', User::first()->homepage);
    }
}
