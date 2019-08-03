<?php

namespace Gistlog\Providers;

use Illuminate\Support\ServiceProvider;
use Gistlog\ContentParser\ContentParser;
use Gistlog\ContentParser\GitHubMarkdownTransformer;
use Gistlog\ContentParser\GitHubUsernameTransformer;

class ContentParserServiceProvider extends ServiceProvider
{
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

            return $parser;
        });
    }
}
