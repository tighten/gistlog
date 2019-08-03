<?php

namespace Gistlog\Providers;

use Gistlog\Gists\GistClient;
use Gistlog\Authors\AuthorClient;
use Github\Client as GitHubClient;
use Illuminate\Support\ServiceProvider;
use Github\HttpClient\CachedHttpClient as CachedGitHubClient;

class AuthorClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AuthorClient::class, function ($app) {
            $githubClient = new GitHubClient;

            // Again, we're only making public API requests, so we don't *need* to
            // authenticate, but doing so significantly increases the rate limit.
            // So here we authenticate if credentials are provided, but if not,
            // no big deal.
            if (config('services.github.token')) {
                $githubClient->authenticate(
                    config('services.github.token'),
                    GitHubClient::AUTH_HTTP_TOKEN
                );
            }

            return new AuthorClient($githubClient, app(GistClient::class));
        });
    }
}
