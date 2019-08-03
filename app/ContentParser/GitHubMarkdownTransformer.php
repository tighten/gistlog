<?php

namespace App\ContentParser;

use Github\Client as GitHubClient;
use Illuminate\Support\Facades\Log;

class GitHubMarkdownTransformer implements Transformer
{
    private $github;

    public function __construct(GitHubClient $github)
    {
        $this->github = $github;
    }

    public function transform($content)
    {
        Log::debug('Calling ' . __METHOD__);

        return $this->github->api('markdown')->render($content, 'gfm');
    }
}
