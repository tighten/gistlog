<?php

namespace App\Providers;

use App\ContentParser\ContentParser;
use App\ContentParser\GitHubMarkdownTransformer;
use Illuminate\Support\ServiceProvider;

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
