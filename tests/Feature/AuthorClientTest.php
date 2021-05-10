<?php

use App\Authors\AuthorClient;

class AuthorClientTest extends BrowserKitTestCase
{
    /**
     * @test
     * @group needsToken
     */
    public function it_authenticates_with_github_and_returns_5000_rate_limit()
    {
        $github = App::make(AuthorClient::class);

        $response = json_decode($github->getGitHubClient()->getHttpClient()->get('rate_limit')->getBody(), true);
        $limit = $response['resources']['core']['limit'];
        $this->assertEquals('5000', $limit);

        $response = json_decode($github->getGistClient()->getGitHubClient()->getHttpClient()->get('rate_limit')->getBody(), true);
        $limit = $response['resources']['core']['limit'];
        $this->assertEquals('5000', $limit);
    }
}
