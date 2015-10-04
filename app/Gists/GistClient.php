<?php

namespace Gistlog\Gists;

use Exception;
use Gistlog\Exceptions\GistNotFoundException;
use Github\Client as GitHubClient;
use Github\HttpClient\Message\ResponseMediator;
use Illuminate\Support\Facades\Auth;

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

    public function getGitHubClient()
    {
        return $this->github;
    }

    /**
     * @param $gistId
     * @return array
     * @throws GistNotFoundException
     */
    public function getGist($gistId)
    {
        try {
            return $this->github->api('gists')->show($gistId);
        } catch (Exception $e) {
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

    /**
     * @param $gistId
     * @param $comment
     * @return array
     */
    public function postGistComment($gistId, $comment)
    {
        $this->github->authenticate(Auth::user()->token, GitHubClient::AUTH_HTTP_TOKEN);
        $response = $this->github->getHttpClient()->post("gists/{$gistId}/comments", json_encode(['body' => $comment]));
        return ResponseMediator::getContent($response);
    }
}
