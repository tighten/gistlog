<?php namespace Gistlog\Gists;

use Carbon\Carbon;
use Michelf\MarkdownExtra;

class Gistlog
{
    public $id;
    public $title;
    public $content;
    public $language;
    public $author;
    public $avatarUrl;
    public $link;
    private $public;

    /**
     * @var Carbon
     */
    public $createdAt;

    /**
     * @var Carbon
     */
    public $updatedAt;

    /**
     * @var Collection
     */
    public $comments;

    /**
     * @param array|ArrayAccess $githubGist
     * @param array|ArrayAccess $githubComments
     * @return Gistlog
     */
    public static function fromGitHub($githubGist, $githubComments = [])
    {
        $gistlog = new self;

        $gistlog->id = $githubGist['id'];
        $gistlog->title = $githubGist['description'];
        $gistlog->content = array_values($githubGist['files'])[0]['content'];
        $gistlog->language = array_values($githubGist['files'])[0]['language'];
        $gistlog->author = $githubGist['owner']['login'];
        $gistlog->avatarUrl = $githubGist['owner']['avatar_url'];
        $gistlog->link = $githubGist['html_url'];
        $gistlog->public = $githubGist['public'];
        $gistlog->createdAt = Carbon::parse($githubGist['created_at']);
        $gistlog->updatedAt = Carbon::parse($githubGist['updated_at']);

        $gistlog->comments = collect($githubComments)->map(function ($comment) {
            return Comment::fromGitHub($comment);
        });

        return $gistlog;
    }

    /**
     * @return string
     */
    public function renderHtml()
    {
        if ($this->language === 'Markdown') {
            return MarkdownExtra::defaultTransform($this->content);
        }
        return '<pre><code>' . $this->content . '</code></pre>';
    }

    /**
     * @return bool
     */
    public function hasComments()
    {
        return $this->comments->count() > 0;
    }

    /**
     * @return bool
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @return bool
     */
    public function isSecret()
    {
        return ! $this->isPublic();
    }
}
