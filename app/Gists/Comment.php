<?php namespace Gistlog\Gists;

use Carbon\Carbon;

class Comment
{
    public $body;
    public $user;
    public $avatarUrl;
    public $updatedAt;

    public static function fromGitHub($githubComment)
    {
        $comment = new self;

        $comment->body = $githubComment['body'];
        $comment->user = $githubComment['user']['login'];
        $comment->avatarUrl = $githubComment['user']['avatar_url'];
        $comment->updatedAt = new Carbon($githubComment['updated_at']);

        return $comment;
    }
}
