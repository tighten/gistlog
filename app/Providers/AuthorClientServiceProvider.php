<?php namespace Gistlog\Providers;

use Gistlog\Authors\AuthorClient;
use Gistlog\Gists\GistClient;
use Github\Client as GitHubClient;
use Github\HttpClient\CachedHttpClient as CachedGitHubClient;
use Illuminate\Support\ServiceProvider;

class AuthorClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AuthorClient::class, function ($app) {

            $githubClient = new GitHubClient(
                new CachedGitHubClient([
                    'cache_dir' => storage_path() . '/app/github-api-cache',
                ])
            );

            // Again, we're only making public API requests, so we don't *need* to
            // authenticate, but doing so significantly increases the rate limit.
            // So here we authenticate if credentials are provided, but if not,
            // no big deal.
            if (config('services.github.client_id') && config('services.github.client_secret')) {
                $githubClient->authenticate(
                    config('services.github.token'),
                    GitHubClient::AUTH_HTTP_TOKEN
                );
            }

            return new AuthorClient($githubClient, app(GistClient::class));
        });
    }
}
