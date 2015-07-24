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
            // throw new Exception($e->getMessage());
            dd("Sorry, but we are working on a fix for the authors page right now running into GitHub's API rate limits. Sorry for the downtime! - Matt");
        }
    }

    /**
     * @param $username
     * @return array
     */
    public function getAuthorGists($username)
    {
        return $this->github->api('users')->gists($username);
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
