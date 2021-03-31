<?php

namespace App\Authors;

use App\CachesGitHubResponses;
use App\Gists\GistClient;
use Exception;
use Github\Client as GitHubClient;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Yaml\Yaml;

class AuthorClient
{
    use CachesGitHubResponses;

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

    public function getGitHubClient()
    {
        return $this->github;
    }

    public function getGistClient()
    {
        return $this->gistClient;
    }

    /**
     * @param $authorSlug
     * @return array
     */
    public function getAuthor($authorSlug)
    {
        return Cache::remember(self::cacheKey(__METHOD__, $authorSlug), $this->cacheLength, function () use ($authorSlug) {
            Log::debug('Calling '.__METHOD__);

            try {
                return $this->github->api('users')->show($authorSlug);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        });
    }

    /**
     * @param $username
     * @return array
     */
    public function getAuthorGists($username)
    {
        return Cache::remember(self::cacheKey(__METHOD__, $username), $this->cacheLength, function () use ($username) {
            Log::debug('Calling '.__METHOD__);

            return $this->github->api('users')->gists($username);
        });
    }

    /**
     * @param $username
     * @return array
     */
    public function getAuthorPublishableGists($username)
    {
        $gists = $this->getAuthorGists($username);

        return array_filter(array_map(function ($gist) {
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

        return ! Arr::get($config, 'published', true);
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
