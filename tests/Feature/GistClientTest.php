<?php

use App\Gists\GistClient;

class GistClientTest extends BrowserKitTestCase
{
    /**
     * @test
     * @group needsToken
     */
    public function it_authenticates_with_github_and_returns_5000_rate_limit()
    {
        $github = app(GistClient::class);
        $response = json_decode($github->getGitHubClient()->getHttpClient()->get('rate_limit')->getBody(), true);
        $limit = $response['resources']['core']['limit'];
        $this->assertEquals('5000', $limit);
    }
}
