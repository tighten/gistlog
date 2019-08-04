<?php

namespace App\Gists;

class GistlogRepository
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
     * @return Gistlog
     */
    public function findById($id)
    {
        return Gistlog::fromGitHub(
            $this->gistClient->getGist($id)
        );
    }

    /**
     * @param string $url
     * @return Gistlog
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
