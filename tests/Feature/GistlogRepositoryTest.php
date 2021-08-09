<?php

use App\Gists\GistlogRepository;
use FixtureGistClient;

class GistlogRepositoryTest extends BrowserKitTestCase
{
    private const FIXTURE_GIST_ID = '002ed429c7c21ab89300';

    /** @test */
    public function it_can_retrieve_a_gist_by_id()
    {
        $gistClient = new FixtureGistClient();
        $gistRepository = new GistlogRepository($gistClient);

        $gist = $gistRepository->findById(self::FIXTURE_GIST_ID);

        $this->assertEquals(self::FIXTURE_GIST_ID, $gist->id);
    }

    /** @test */
    public function it_can_retrieve_gists_by_url()
    {
        $url = 'https://gist.github.com/adamwathan/' . self::FIXTURE_GIST_ID;

        $gistClient = new FixtureGistClient();
        $gistRepository = new GistlogRepository($gistClient);

        $gist = $gistRepository->findByUrl($url);

        $this->assertEquals(self::FIXTURE_GIST_ID, $gist->id);
    }

    /** @test */
    public function it_can_retrieve_gists_by_url_with_a_trailing_slash()
    {
        $url = 'https://gist.github.com/adamwathan/' . self::FIXTURE_GIST_ID . '/';

        $gistClient = new FixtureGistClient();
        $gistRepository = new GistlogRepository($gistClient);

        $gist = $gistRepository->findByUrl($url);

        $this->assertEquals(self::FIXTURE_GIST_ID, $gist->id);
    }
}
