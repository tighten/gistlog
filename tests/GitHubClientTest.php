<?php

use Github\Client as GitHubClient;

class GitHubClientTest extends TestCase
{
    /** @test */
    public function it_authenticates_with_github_and_returns_5000_rate_limit_guzzle()
    {
        $github = App::make(GitHubClient::class);

        $response = $github->getHttpClient()->get('rate_limit')->json();

        $limit = $response['resources']['core']['limit'];

        $this->assertEquals('5000', $limit);
    }
}
