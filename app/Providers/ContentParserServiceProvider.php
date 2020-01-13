<?php

namespace App\Providers;

use App\ContentParser\ContentParser;
use Illuminate\Support\ServiceProvider;
use App\ContentParser\GitHubMarkdownTransformer;
use App\ContentParser\GitHubUsernameTransformer;

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
