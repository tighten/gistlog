<?php

use Github\Client as GitHubClient;

class GitHubClientTest extends TestCase
{

    /** @test */
    public function it_authenticates_with_github_and_returns_5000_rate_limit()
    {
        $github = App::make(GitHubClient::class);

        $limit = $github->api('rate_limit')->getCoreLimit();

        $this->assertEquals('5000', $limit);
    }
}
