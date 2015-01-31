<?php  namespace Gistlog\Gists;

use Carbon\Carbon;
use Michelf\MarkdownExtra;

class Gist
{
    public $id;
    public $title;
    public $content;
    public $author;
    public $avatarUrl;
    public $link;
    public $createdAt;
    public $updatedAt;
    public $comments = [];

    public static function fromGitHub($githubGist, $githubComments = [])
    {
        $gist = new self;

        $gist->id = $githubGist['id'];
        $gist->title = $githubGist['description'];
        $gist->content = array_values($githubGist['files'])[0]['content'];
        $gist->author = $githubGist['owner']['login'];
        $gist->avatarUrl = $githubGist['owner']['avatar_url'];
        $gist->link = $githubGist['html_url'];
        $gist->createdAt = new Carbon($githubGist['created_at']);
        $gist->updatedAt = new Carbon($githubGist['updated_at']);

        $gist->comments = array_map(function ($comment) {
            return Comment::fromGitHub($comment);
        }, $githubComments);

        return $gist;
    }

    public function renderHtml()
    {
        return MarkdownExtra::defaultTransform($this->content);
    }
}
