<?php  namespace Gistlog\Gists;

class GistRepository
{
    /**
     * @var GistClient
     */
    private $gistClient;

    public function __construct(GistClient $gistClient)
    {
        $this->gistClient = $gistClient;
    }

    /**
     * @param $id
     * @return Gist
     */
    public function findById($id)
    {
        $gist = $this->gistClient->getGist($id);
        $comments = $this->gistClient->getGistComments($id);

        return Gist::fromGitHub($gist, $comments);
    }

    /**
     * @param string $url
     * @return Gist
     */
    public function findByUrl($url)
    {
        return $this->findById($this->extractIdFromUrl($url));
    }

    /**
     * @param string $url
     * @return string
     */
    private function extractIdFromUrl($url)
    {
        $url = rtrim($url, '/');
        return last(explode('/', $url));
    }
}
