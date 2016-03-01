<?php namespace Gistlog\Gists;

use Carbon\Carbon;
use Cache;
use Gistlog\Authors\Author;
use Gistlog\ContentParser\ContentParserFacade as ContentParser;

class Gistlog
{
    public $id;
    public $title;
    public $content;
    public $language;
    public $author;
    public $avatarUrl;
    public $link;
    public $config;
    public $files;
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

        $files = File::multipleFromGitHub($githubGist['files']);
        $postFile = $files->getPostFile();

        $gistlog->id = $githubGist['id'];
        $gistlog->title = $githubGist['description'];

        $gistlog->content = $postFile->content;
        $gistlog->language = $postFile->language;
        $gistlog->link = $githubGist['html_url'];
        $gistlog->public = $githubGist['public'];
        $gistlog->createdAt = Carbon::parse($githubGist['created_at']);
        $gistlog->updatedAt = Carbon::parse($githubGist['updated_at']);

        if (isset($githubGist['owner'])) {
            $gistlog->author = $githubGist['owner']['login'];
            $gistlog->avatarUrl = $githubGist['owner']['avatar_url'];
        } else {
            $gistlog->author = Author::ANONYMOUS_USERNAME;
            $gistlog->avatarUrl = Author::ANONYMOUS_AVATAR_URL;
        }

        $gistlog->comments = collect($githubComments)->map(function ($comment) use ($githubGist) {
            return Comment::fromGitHub($githubGist['id'], $comment);
        });

        $gistlog->config = GistConfig::fromGitHub($githubGist);
        $gistlog->files = $gistlog->showFiles() ? $files->getAdditionalFiles() : new FileCollection([]);

        return $gistlog;
    }

    /**
     * @return string
     */
    public function renderHtml()
    {
        if ($this->language === 'Markdown') {
            return $this->renderMarkdown();
        }

        return "<pre><code>" . htmlspecialchars($this->content) . "\n</code></pre>";
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

    /**
     * @return bool
     */
    public function isAnonymous()
    {
        return $this->author === Author::ANONYMOUS_USERNAME;
    }

    public function getPreview()
    {
        if (! is_null($this->config['preview'])) {
            return $this->config['preview'];
        }

        $body = strip_tags($this->renderHtml());

        if (strlen($body) < 200) {
            return $body;
        }

        return substr($body, 0, strpos($body, ' ', 200));
    }

    public function showFiles()
    {
        return $this->config['include_files'];
    }

    private function renderMarkdown()
    {
        if ($this->updatedAt == Cache::get('markdown.updated_at.' . $this->id)) {
            return Cache::get('markdown.' . $this->id);
        }

        $markdown = ContentParser::transform($this->content);

        Cache::forever('markdown.' . $this->id, $markdown);
        Cache::forever('markdown.updated_at.' . $this->id, $this->updatedAt);

        return $markdown;
    }
}
