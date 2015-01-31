<?php

use Gistlog\Gists\GistRepository;
use Gistlog\Gists\GistClient;

class GistRepositoryTest extends TestCase
{
    const FIXTURE_GIST_ID = '548944';

    /** @test */
    public function it_can_retrieve_a_gist_by_id()
    {
        $gistClient = new FixtureGistClient;
        $gistRepository = new GistRepository($gistClient);

        $gist = $gistRepository->findById(self::FIXTURE_GIST_ID);

        $this->assertEquals(self::FIXTURE_GIST_ID, $gist->id);
    }

    /** @test */
    public function it_embeds_gist_comments()
    {
        $gistClient = new FixtureGistClient;
        $gistRepository = new GistRepository($gistClient);

        $gist = $gistRepository->findById(self::FIXTURE_GIST_ID);

        $this->assertCount(2, $gist->comments);
        $this->assertEquals("I like it! When will it be pushed?", $gist->comments[0]->body);
        $this->assertEquals("Hope soon. I will give this a try this weekend.", $gist->comments[1]->body);
    }
}

class FixtureGistClient extends GistClient
{
    use GistFixtureHelpers;

    public function __construct() {}

    public function getGist($gistId)
    {
        return $this->loadFixture($gistId . '.json');
    }

    public function getGistComments($gistId)
    {
        return $this->loadFixture($gistId . '/comments.json');
    }
}
