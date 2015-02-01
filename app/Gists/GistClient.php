<?php  namespace Gistlog\Gists;

use GuzzleHttp\Client;

class GistClient
{
    private $baseUrl = 'https://api.github.com/gists/';

    /**
     * @var Client
     */
    private $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * @param $gistId
     * @return array
     */
    public function getGist($gistId)
    {
        return $this->get($gistId);
    }

    /**
     * @param $gistId
     * @return array
     */
    public function getGistComments($gistId)
    {
        return $this->get($gistId . '/comments');
    }

    /**
     * @param string $url
     * @return array
     */
    private function get($url)
    {
        return $this->guzzle->get($this->baseUrl . $url)->json();
    }
}
