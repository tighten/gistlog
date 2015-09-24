<?php namespace Gistlog\ContentParser;

use Github\Client;
use Github\HttpClient\Message\ResponseMediator;

class MarkdownTransformer implements Transformer
{
    private $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function transform($content)
    {
        return $this->client->api('markdown')->render($content);
    }
}
