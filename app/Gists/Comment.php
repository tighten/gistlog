<?php namespace Gistlog\Gists;

use Carbon\Carbon;

class Comment
{
    use MarkdownRenderable;

    public $body;
    public $author;
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
        $comment->author = $githubComment['user']['login'];
        $comment->avatarUrl = $githubComment['user']['avatar_url'];
        $comment->updatedAt = Carbon::parse($githubComment['updated_at']);

        return $comment;
    }

    /**
     * @return string
     */
    public function renderHtml()
    {
       return $this->render($this->body);
    }
}
