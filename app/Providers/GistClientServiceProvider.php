<?php

namespace App\Providers;

use App\Gists\GistClient;
use Github\Client as GitHubClient;
use Illuminate\Support\ServiceProvider;
use Github\HttpClient\CachedHttpClient as CachedGitHubClient;

class GistClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(GistClient::class, function ($app) {
            $githubClient = new GitHubClient;

            // We're only making public API requests, so we don't *need* to
            // authenticate, but doing so significantly increases the rate
            // limit. So here we authenticate if credentials are provided,
            // but if they aren't, no big deal.
            if (config('services.github.client_id') && config('services.github.client_secret')) {
                $githubClient->authenticate(
                    config('services.github.client_id'),
                    config('services.github.client_secret'),
                    GitHubClient::AUTH_HTTP_PASSWORD
                );
            }

            return new GistClient($githubClient);
        });
    }
}
