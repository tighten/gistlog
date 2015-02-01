<?php  namespace Gistlog\Gists;

use Gistlog\Exceptions\GistNotFoundException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

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
     * @throws GistNotFoundException
     */
    public function getGist($gistId)
    {
        try {
            return $this->get($gistId);
        } catch (ClientException $e) {
            throw new GistNotFoundException("Gist not found.");
        }
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
