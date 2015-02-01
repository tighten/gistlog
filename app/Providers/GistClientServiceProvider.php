<?php namespace Gistlog\Providers;

use Gistlog\Gists\GistClient;
use Github\Client as GitHubClient;
use Github\HttpClient\CachedHttpClient as CachedGitHubClient;
use Illuminate\Support\ServiceProvider;

class GistClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(GistClient::class, function ($app) {

            $githubClient = new GitHubClient(
                new CachedGitHubClient([
                    'cache_dir' => storage_path() . '/app/github-api-cache',
                ])
            );

            return new GistClient($githubClient);
        });
    }
}
