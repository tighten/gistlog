<?php

namespace App\Providers;

use Github\Client;
use Illuminate\Support\ServiceProvider;

class GitHubClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            $githubClient = new Client;

            // We're only making public API requests, so we don't *need* to
            // authenticate, but doing so significantly increases the rate
            // limit. So here we authenticate if credentials are provided,
            // but if they aren't, no big deal.
            if (config('services.github.client_id') && config('services.github.client_secret')) {
                $githubClient->authenticate(
                    config('services.github.client_id'),
                    config('services.github.client_secret'),
                    Client::AUTH_HTTP_PASSWORD
                );
            }

            return $githubClient;
        });
    }
}
