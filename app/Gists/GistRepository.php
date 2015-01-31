<?php  namespace Gistlog\Gists;

class GistRepository
{
    private $gistClient;

    public function __construct(GistClient $gistClient)
    {
        $this->gistClient = $gistClient;
    }

    public function findById($id)
    {
        $gist = $this->gistClient->getGist($id);
        $comments = $this->gistClient->getGistComments($id);

        return Gist::fromGitHub($gist, $comments);
    }

    public function findByUrl($url)
    {
        return $this->findById($this->extractIdFromUrl($url));
    }

    private function extractIdFromUrl($url)
    {
        $url = rtrim($url, '/');
        return last(explode('/', $url));
    }
}
