<?php

namespace App\Gists;

use App\CachesGitHubResponses;
use App\Exceptions\GistNotFoundException;
use Exception;
use Github\Client as GitHubClient;
use Github\HttpClient\Message\ResponseMediator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class GistClient
{
    use CachesGitHubResponses;

    /**
     * @var GitHubClient
     */
    private $github;

    public function __construct(GitHubClient $github)
    {
        $this->github = $github;
    }

    public function getGitHubClient(): GitHubClient
    {
        return $this->github;
    }

    /**
     * @throws GistNotFoundException
     */
    public function getGist($gistId): array
    {
        return Cache::remember(self::cacheKey(__METHOD__, $gistId), $this->cacheLength, function () use ($gistId) {
            Log::debug('Calling ' . __METHOD__);

            try {
                return $this->github->api('gists')->show($gistId);
            } catch (Exception $e) {
                throw new GistNotFoundException($gistId, $e->getMessage());
            }
        });
    }

    public function getGistComments($gistId): array
    {
        // No cache here so we can have just a single cache layer (post-transformation) to reset when needed
        // return Cache::remember(self::cacheKey(__METHOD__, $gistId), $this->cacheLength, function () use ($gistId) {
        Log::debug('Calling ' . __METHOD__);

        return ResponseMediator::getContent(
            $this->github->getHttpClient()->get("/gists/{$gistId}/comments")
        );
    }

    public function postGistComment($gistId, string $comment): array
    {
        $this->github->authenticate(Auth::user()->token, GitHubClient::AUTH_ACCESS_TOKEN);
        $response = $this->github->getHttpClient()->post("gists/{$gistId}/comments", [], json_encode(['body' => $comment]));

        return ResponseMediator::getContent($response);
    }

    public function starGist($gistId)
    {
        if (Auth::guest()) {
            return;
        }

        if (Auth::check()) {
            Cache::forget(self::class . "::starCount::{$gistId}");

            $this->github->authenticate(Auth::user()->token, GitHubClient::AUTH_ACCESS_TOKEN);
            $this->github->getHttpClient()->put("https://api.github.com/gists/{$gistId}/star", [], json_encode(['body' => '']), ['Content-Length' => 0]);
        }
    }

    public function unstarGist($gistId)
    {
        if (Auth::guest()) {
            return;
        }

        Cache::forget(self::class . "::starCount::{$gistId}");

        $this->github->authenticate(Auth::user()->token, GitHubClient::AUTH_ACCESS_TOKEN);
        $this->github->getHttpClient()->delete("https://api.github.com/gists/{$gistId}/star");
    }

    public function isStarredForUser($gistId): bool
    {
        if (Auth::guest()) {
            return false;
        }

        // @todo: Consider reworking this to not catch *all* exceptions, but just
        //        check whether the HTTP status code is 404 (false) or 204 (starred)
        try {
            $this->github->authenticate(Auth::user()->token, GitHubClient::AUTH_ACCESS_TOKEN);
            $this->github->getHttpClient()->get("https://api.github.com/gists/{$gistId}/star");

            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

    public function starCount($gistId)
    {
        if (Auth::guest()) {
            return false;
        }

        $query = 'query { viewer {login gist(name: "' . $gistId . '") {stargazerCount}}}';

        return Cache::remember(self::cacheKey(__METHOD__, $gistId), $this->cacheLength, function () use ($query) {
            Log::debug('Calling ' . __METHOD__);

            $response = Http::withHeaders([
                'Authorization' => 'bearer ' . Auth::user()->token,
                'Content-Type' => 'application/json',
            ])->post('https://api.github.com/graphql', ['query' => $query]);

            return $response->json();
        });
    }
}
