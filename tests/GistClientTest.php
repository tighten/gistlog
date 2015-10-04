<?php

use Gistlog\Gists\GistClient;

class GistClientTest extends TestCase
{
    /** @test */
    public function it_authenticates_with_github_and_returns_5000_rate_limit()
    {
        $github = App::make(GistClient::class);
        $response = $github->getGitHubClient()->getHttpClient()->get('rate_limit')->json();
        $limit = $response['resources']['core']['limit'];
        $this->assertEquals('5000', $limit);
    }
}
