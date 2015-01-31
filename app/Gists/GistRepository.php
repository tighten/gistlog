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
}
