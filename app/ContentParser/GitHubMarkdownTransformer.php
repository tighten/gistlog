<?php namespace Gistlog\ContentParser;

use Github\Client as GitHubClient;

class GitHubMarkdownTransformer implements Transformer
{
    private $github;

    public function __construct(GitHubClient $github)
    {
        $this->github = $github;
    }

    public function transform($content)
    {
        return $this->github->api('markdown')->render($content, 'gfm');
    }
}
