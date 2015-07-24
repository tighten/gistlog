<?php  namespace Gistlog\Gists;

use Exception;

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
    public function GetGist($gistId) {
        try {
            return $this->github->api('gists')->show($gistId);
        } catch (Exception $e){
            throw new GistNotFoundException($gistId, $e->getMessage());
        }
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
}
