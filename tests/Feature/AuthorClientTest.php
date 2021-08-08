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
        $github = app(AuthorClient::class);

        $response = json_decode($github->getGitHubClient()->getHttpClient()->get('/rate_limit')->getBody(), true);
        $limit = $response['resources']['core']['limit'];

        if (config('services.github.client_id') && config('services.github.client_secret')) {
            $this->assertEquals(5000, $limit);
        } else {
            $this->assertEquals(60, $limit);
        }

        $response = json_decode($github->getGistClient()->getGitHubClient()->getHttpClient()->get('/rate_limit')->getBody(), true);
        $limit = $response['resources']['core']['limit'];

        if (config('services.github.client_id') && config('services.github.client_secret')) {
            $this->assertEquals(5000, $limit);
        } else {
            $this->assertEquals(60, $limit);
        }
    }
}
