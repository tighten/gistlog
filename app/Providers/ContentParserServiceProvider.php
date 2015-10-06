<?php

namespace Gistlog\Providers;

use Github\Client as GitHubClient;
use Gistlog\ContentParser\ContentParser;
use Gistlog\ContentParser\GitHubUsernameTransformer;
use Gistlog\ContentParser\GitHubMarkdownTransformer;
use Illuminate\Support\ServiceProvider;

class ContentParserServiceProvider extends ServiceProvider {

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ContentParser::class, function ($app) {
            $parser = new ContentParser;

            $parser->push($app[GitHubMarkdownTransformer::class]);
            $parser->push($app[GitHubUsernameTransformer::class]);

            return $parser;
        });
    }
}
