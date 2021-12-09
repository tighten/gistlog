<?php

namespace App\Authors;

use App\Gists\Gistlog;
use Illuminate\Support\Arr;

class Author
{
    public const ANONYMOUS_USERNAME = 'anonymous';

    public const ANONYMOUS_AVATAR_URL = 'https://avatars3.githubusercontent.com/u/148100?v=3&s=400';

    public $id;

    public $avatarUrl;

    public $link;

    public $name;

    public $username;

    public $bio;

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
        $author = new self();

        $author->id = $gitHubUser['id'];
        $author->avatarUrl = $gitHubUser['avatar_url'];
        $author->link = $gitHubUser['html_url'];
        $author->name = Arr::get($gitHubUser, 'name');
        $author->username = $gitHubUser['login'];
        $author->bio = $gitHubUser['bio'];

        $author->gists = collect($gitHubGists)->map(function ($gist) {
            return Gistlog::fromGitHub($gist);
        });

        return $author;
    }

    public static function getAnonymous()
    {
        $author = new self();

        $author->id = 0;
        $author->avatarUrl = self::ANONYMOUS_AVATAR_URL;
        $author->link = 'https://github.com/' . self::ANONYMOUS_USERNAME;
        $author->name = 'anonymous';
        $author->username = self::ANONYMOUS_USERNAME;
        $author->gists = collect([]);
        $author->bio = null;

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
