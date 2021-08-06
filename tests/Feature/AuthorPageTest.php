<?php

use App\Authors\Author;
use App\Authors\AuthorRepository;
use App\Gists\Gistlog;
use Carbon\Carbon;
use Mockery\MockInterface;

class AuthorPageTest extends TestCase
{

    /** @test */
    public function a_user_can_visit_the_author_page() {
        $this->withoutExceptionHandling();
        $gist1 = $this->createGist([
            'id' => '234234',
            'title'=>'My title',
            'body'=>'my body',
        ]);
        $gist2 = $this->createGist([
            'id' => '234234',
            'title'=>'My Second title',
            'body'=>'my second body',
        ]);

        $author = $this->createAuthor([
            'id'=>'234234',
            'avatarUrl'=>'https://avatars.githubusercontent.com/u/151829?v=4',
            'link'=>'https://github.com/mattstauffer',
            'name'=>'Matt Stauffer',
            'username'=>'@mattstauffer',
            'gists'=>[$gist1, $gist2]
        ]);

        $this->instance(
            AuthorRepository::class,
            Mockery::mock(AuthorRepository::class, function (MockInterface $mock) use ($author) {
                $mock->shouldReceive('findByUsername')->once()->andReturn($author);
            })
        );
        $response = $this->get('/mattstauffer');
        $response->assertOk();
        $response->assertSee('My title');
        $response->assertSee('My Second title');
    }

    public function createAuthor($authorArray)
    {
        $author = new Author;
        $author->id = $authorArray['id'];
        $author->avatarUrl = $authorArray['avatarUrl'];
        $author->name = $authorArray['name'];
        $author->username = $authorArray['username'];
        $author->gists = collect($authorArray['gists']);
        return $author;
    }

    public function createGist($gistArray)
    {
        $gist = new Gistlog;
        $gist->id = $gistArray['id'];
        $gist->title = $gistArray['title'];
        $gist->createdAt = Carbon::parse('-1 week');
        $gist->body = $gistArray['body'];
        $gist->config = ['preview'=>null];
        return $gist;
    }
}
