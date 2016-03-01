<?php namespace Gistlog\Authors;

use Gistlog\Gists\Gistlog;

class Author
{
    public $id;
    public $avatarUrl;
    public $link;
    public $name;
    public $username;

    /**
     * @var Collection
     */
    public $gists;

    /**
     * @param array|ArrayAccess $gitHubUser
     * @param array|ArrayAccess $gitHubGists
     * @return Author
     */
    public static function fromGitHub($gitHubUser, $gitHubGists = [])
    {
        $author = new self;

        $author->id = $gitHubUser['id'];
        $author->avatarUrl = $gitHubUser['avatar_url'];
        $author->link = $gitHubUser['html_url'];
        $author->name = array_get($gitHubUser, 'name');
        $author->username = $gitHubUser['login'];

        $author->gists = collect($gitHubGists)->map(function ($gist) {
            return Gistlog::fromGitHub($gist);
        });

        return $author;
    }

    public static function getAnonymous()
    {
        $author = new self;

        $author->id = 0;
        $author->avatarUrl = 'https://avatars3.githubusercontent.com/u/148100?v=3&s=400';
        $author->link = 'https://github.com/anonymous';
        $author->name = 'anonymous';
        $author->username = 'anonymous';
        $author->gists = collect();

        return $author;
    }

    /**
     * @return bool
     */
    public function hasGists()
    {
        return $this->gists->count() > 0;
    }
}
