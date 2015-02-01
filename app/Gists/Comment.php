<?php namespace Gistlog\Gists;

use Carbon\Carbon;

class Comment
{
    public $body;
    public $user;
    public $avatarUrl;

    /**
     * @var Carbon
     */
    public $updatedAt;

    /**
     * @param array|ArrayAccess $githubComment
     * @return Comment
     */
    public static function fromGitHub($githubComment)
    {
        $comment = new self;

        $comment->body = $githubComment['body'];
        $comment->user = $githubComment['user']['login'];
        $comment->avatarUrl = $githubComment['user']['avatar_url'];
        $comment->updatedAt = Carbon::parse($githubComment['updated_at']);

        return $comment;
    }
}
