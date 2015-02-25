<?php  namespace Gistlog\Authors;

use Exception;

use Gistlog\Gists\GistClient;
use Github\Client as GitHubClient;
use Github\HttpClient\Message\ResponseMediator;

class AuthorClient
{
    /**
     * @var GitHubClient
     */
    private $github;
    /**
     * @var GistClient
     */
    private $gistClient;

    public function __construct(GitHubClient $github, GistClient $gistClient)
    {
        $this->github = $github;
        $this->gistClient = $gistClient;
    }

    /**
     * @param $authorSlug
     * @return array
     * @throws GistNotFoundException
     */
    public function getAuthor($authorSlug)
    {
        try {
            return $this->github->api('users')->show($authorSlug);
        } catch (Exception $e) {
            throw new GistNotFoundException($gistId, $e->getMessage());
        }
    }

    /**
     * @param $username
     * @return array
     */
    public function getAuthorGists($username)
    {
        $response = $this->github->getHttpClient()->get("users/{$username}/gists");
        return ResponseMediator::getContent($response);
    }

    /**
     * @param $username
     * @return array
     */
    public function getAuthorPublishableGists($username)
    {
        $gists = $this->getAuthorGists($username);

        return array_filter(array_map(function($gist) {
            if ($this->gistIsGistlogPublished($gist)) {
                $fullGist = $this->gistClient->getGist($gist['id']);

                if (! $this->gistIsDraft($fullGist)) {
                    return $fullGist;
                }
            }
        }, $gists));
    }

    private function gistIsDraft($gist)
    {
        $config = $gist['files']['gistlog.yml'];
        dd($config['content']);
    }

    /**
     * @param array $gist
     * @return bool
     */
    private function gistIsGistlogPublished($gist)
    {
        if (count($gist['files']) == 0) {
            return false;
        }

        foreach ($gist['files'] as $file) {
            if ($file['filename'] == 'gistlog.yml') {
                return true;
            }
        }

        return false;
    }
}
