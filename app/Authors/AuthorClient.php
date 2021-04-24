<?php

namespace App\Authors;

use App\CachesGitHubResponses;
use App\Gists\GistClient;
use Exception;
use Github\Client as GitHubClient;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Yaml\Exception\ParseException;
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

    public function getGitHubClient(): GitHubClient
    {
        return $this->github;
    }

    public function getGistClient(): GistClient
    {
        return $this->gistClient;
    }

    public function getAuthor(string $authorSlug): array
    {
        return Cache::remember(self::cacheKey(__METHOD__, $authorSlug), $this->cacheLength, function () use ($authorSlug) {
            try {
                return $this->github->api('users')->show($authorSlug);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        });
    }

    public function getAuthorGists(string $username): array
    {
        return Cache::remember(self::cacheKey(__METHOD__, $username), $this->cacheLength, function () use ($username) {
            return $this->github->api('users')->gists($username);
        });
    }

    public function getAuthorPublishableGists(string $username): array
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

    private function gistIsDraft(array $gist): bool
    {
        try {
            $config = Yaml::parse($gist['files']['gistlog.yml']['content']);
        } catch (ParseException $exception) {
            return false;
        }

        return ! Arr::get($config, 'published', true);
    }

    private function gistIsGistlogPublished(array $gist): bool
    {
        return array_key_exists('gistlog.yml', $gist['files']);
    }
}
