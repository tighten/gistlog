<?php

use Gistlog\Authors\AuthorClient;

class AuthorClientTest extends TestCase
{
    /** @test */
    public function it_authenticates_with_github_and_returns_5000_rate_limit()
    {
        $github = App::make(AuthorClient::class);

        $response = $github->getGitHubClient()->getHttpClient()->get('rate_limit')->json();
        $limit = $response['resources']['core']['limit'];
        $this->assertEquals('5000', $limit);

        $response = $github->getGistClient()->getGitHubClient()->getHttpClient()->get('rate_limit')->json();
        $limit = $response['resources']['core']['limit'];
        $this->assertEquals('5000', $limit);
    }
}
