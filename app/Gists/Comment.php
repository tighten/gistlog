<?php

namespace App\Gists;

use App\ContentParser\ContentParserFacade as ContentParser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Comment
{
    public $gistId;

    public $body;

    public $author;

    public $avatarUrl;

    public $id;

    /**
     * @var Carbon
     */
    public $updatedAt;

    /**
     * @param array|ArrayAccess $githubComment
     * @return Comment
     */
    public static function fromGitHub($gistId, $githubComment)
    {
        $comment = new self();

        $comment->gistId = $gistId;
        $comment->body = $githubComment['body'];
        $comment->author = $githubComment['user']['login'];
        $comment->avatarUrl = $githubComment['user']['avatar_url'];
        $comment->updatedAt = Carbon::parse($githubComment['updated_at']);
        $comment->id = $githubComment['id'];

        return $comment;
    }

    /**
     * @return string
     */
    public function renderHtml()
    {
        return Cache::remember($this->cacheKey(), 3600, function () {
            return ContentParser::transform($this->body);
        });
    }

    public function link()
    {
        return "https://gist.github.com/{$this->gistId}#gistcomment-{$this->id}";
    }

    public function cacheKey()
    {
        return "CommentAsHtml::gist-{$this->gistId}::gist-comment-{$this->id}}";
    }
}
