<?php  namespace Gistlog\Authors;

use Exception;

use Gistlog\Gists\GistClient;
use Github\Client as GitHubClient;
use Github\HttpClient\Message\ResponseMediator;
use Symfony\Component\Yaml\Yaml;

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
     */
    public function getAuthor($authorSlug)
    {
        try {
            return $this->github->api('users')->show($authorSlug);
        } catch (Exception $e) {
            // throw new GistNotFoundException($gistId, $e->getMessage());
            throw new Exception($e->getMessage());
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

    /**
     * @param array $gist
     * @return bool
     */
    private function gistIsDraft($gist)
    {
        $config = Yaml::parse($gist['files']['gistlog.yml']['content']);

        return ! array_get($config, 'published', true);
    }

    /**
     * @param array $gist
     * @return bool
     */
    private function gistIsGistlogPublished($gist)
    {
        return array_key_exists('gistlog.yml', $gist['files']);
    }
}
