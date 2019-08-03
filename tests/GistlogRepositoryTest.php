<?php

use App\Gists\Gistlog;
use App\Gists\GistClient;
use App\Gists\GistlogRepository;

class GistlogRepositoryTest extends TestCase
{
    const FIXTURE_GIST_ID = '002ed429c7c21ab89300';

    /** @test */
    public function it_can_retrieve_a_gist_by_id()
    {
        $gistClient = new FixtureGistClient;
        $gistRepository = new GistlogRepository($gistClient);

        $gist = $gistRepository->findById(self::FIXTURE_GIST_ID);

        $this->assertEquals(self::FIXTURE_GIST_ID, $gist->id);
    }

    /** @test */
    public function it_embeds_gist_comments()
    {
        $gistClient = new FixtureGistClient;
        $gistRepository = new GistlogRepository($gistClient);

        $gist = $gistRepository->findById(self::FIXTURE_GIST_ID);

        $this->assertCount(2, $gist->comments);
        $this->assertEquals('Interesting post.', $gist->comments[0]->body);
        $this->assertEquals("Here's another comment!", $gist->comments[1]->body);
    }

    /** @test */
    public function it_can_retrieve_gists_by_url()
    {
        $url = 'https://gist.github.com/adamwathan/'.self::FIXTURE_GIST_ID;

        $gistClient = new FixtureGistClient;
        $gistRepository = new GistlogRepository($gistClient);

        $gist = $gistRepository->findByUrl($url);

        $this->assertEquals(self::FIXTURE_GIST_ID, $gist->id);
    }

    /** @test */
    public function it_can_retrieve_gists_by_url_with_a_trailing_slash()
    {
        $url = 'https://gist.github.com/adamwathan/'.self::FIXTURE_GIST_ID.'/';

        $gistClient = new FixtureGistClient;
        $gistRepository = new GistlogRepository($gistClient);

        $gist = $gistRepository->findByUrl($url);

        $this->assertEquals(self::FIXTURE_GIST_ID, $gist->id);
    }
}

class FixtureGistClient extends GistClient
{
    use GistFixtureHelpers;

    public function __construct()
    {
    }

    public function getGist($gistId)
    {
        return $this->loadFixture($gistId.'.json');
    }

    public function getGistComments($gistId)
    {
        return $this->loadFixture($gistId.'/comments.json');
    }
}
