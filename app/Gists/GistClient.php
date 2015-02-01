<?php  namespace Gistlog\Gists;

use Gistlog\Exceptions\GistNotFoundException;

use Github\Client as GitHubClient;
use Github\HttpClient\Message\ResponseMediator;

class GistClient
{
    /**
     * @var GitHubClient
     */
    private $github;

    public function __construct(GitHubClient $github)
    {
        $this->github = $github;
    }

    /**
     * @param $gistId
     * @return array
     * @throws GistNotFoundException
     */
    public function getGist($gistId)
    {
        // @todo Exception handling, not sure what this library throws
        return $this->github->api('gists')->show($gistId);
    }

    /**
     * @param $gistId
     * @return array
     */
    public function getGistComments($gistId)
    {
        $response = $this->github->getHttpClient()->get("gists/{$gistId}/comments");
        return ResponseMediator::getContent($response);
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
