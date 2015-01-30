<?php  namespace Gistlog\Gists;

use Github\Client;

class GistRepository
{
    /**
     * @var Client
     */
    private $github;

    public function __construct(Client $github)
    {
        $this->github = $github;
    }

    /**
     * @param $url
     * @return Gist
     */
    public function getByUrl($url)
    {
        $id = $this->extractIdFromUrl($url);

        return $this->getById($id);
    }

    private function extractIdFromUrl($url)
    {
        $segments = explode('/', $url);

        return last($segments);
    }

    /**
     * @param $id
     * @return Gist
     */
    public function getById($id)
    {
        // @todo Get from cache if exists

        $gist = $this->github->gists()->show($id);

        return Gist::fromGithub($gist);
    }

    /**
     * @param string $userName
     * @param string $gistId
     * @return Gist
     * @throws \Exception
     */
    public function getByUserNameAndId($userName, $gistId)
    {
        $gist = $this->getById($gistId);

        if ($gist->userName != $userName) {
            throw new \Exception('Wrong userName for this Gist');
        }

        return $gist;
    }
}
