<?php

namespace Gistlog\Providers;

use Gistlog\ContentParser\ContentParser;
use Gistlog\ContentParser\GitHubUsernameTransformer;
use Gistlog\ContentParser\MarkdownTransformer;
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
        $this->app->singleton(ContentParser::class, function () {
            $parser = new ContentParser;

            $parser->push(new MarkdownTransformer);
            $parser->push(new GitHubUsernameTransformer);

            return $parser;
        });
    }
}
