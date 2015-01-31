<?php  namespace Gistlog\Gists;

use Guzzle\Http\Client;

class GistClient
{
    private $baseUrl = 'https://api.github.com/gists/';
    private $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function getGist($gistId)
    {
        return $this->get($gistId);
    }

    public function getGistComments($gistId)
    {
        return $this->get($gistId . '/comments');
    }

    private function get($url)
    {
        $response = $this->guzzle->get($this->baseUrl . $url)->send();
        return $response->json();
    }
}
