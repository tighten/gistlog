<?php

use App\Authors\Author;
use App\Authors\AuthorRepository;
use App\Gists\Gistlog;
use Carbon\Carbon;
use Mockery\MockInterface;

class AuthorPageTest extends TestCase
{
    private $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker\Factory::create();
    }

    /** @test */
    public function a_user_can_visit_the_author_page()
    {
        $gist1 = $this->createGist([
            'title' => 'My title',
        ]);
        $gist2 = $this->createGist([
            'title' => 'My Second title',
        ]);

        $author = $this->createAuthor([
            'name' => 'Matt Stauffer',
            'gists' => [$gist1, $gist2]
        ]);

        $this->instance(
            AuthorRepository::class,
            Mockery::mock(AuthorRepository::class, function (MockInterface $mock) use ($author) {
                $mock->shouldReceive('findByUsername')->once()->andReturn($author);
            })
        );
        $response = $this->get('/mattstauffer');
        $response->assertOk();
        $response->assertSee('Matt Stauffer');
        $response->assertSee('My title');
        $response->assertSee('My Second title');
    }

    public function createAuthor($authorArray = [])
    {
        $author = new Author();
        $author->id = $authorArray['id'] ?? $this->faker->numberBetween(10000, 90000);
        $author->avatarUrl = $authorArray['avatarUrl'] ?? 'https://avatars.githubusercontent.com/u/151829?v=4';
        $author->name = $authorArray['name'] ?? $this->faker->name();
        $author->username = $authorArray['username'] ?? $this->faker->username();
        $author->gists = collect($authorArray['gists']) ?? collect([]);
        return $author;
    }

    public function createGist($gistArray = [])
    {
        $gist = new Gistlog();
        $gist->id = $gistArray['id'] ?? $this->faker->numberBetween(10000, 90000);
        $gist->title = $gistArray['title'] ?? $this->faker->sentence();
        $gist->createdAt = Carbon::parse('-1 week');
        $gist->body = $gistArray['body'] ?? $this->faker->paragraph();
        $gist->config = ['preview' => null];
        return $gist;
    }
}
