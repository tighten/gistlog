<?php

use App\Gists\GistClient;

class FixtureGistClient extends GistClient
{
    use GistFixtureHelpers;

    public function __construct()
    {
    }

    public function getGist($gistId): array
    {
        return $this->loadFixture($gistId . '.json');
    }

    public function getGistComments($gistId): array
    {
        return $this->loadFixture($gistId . '/comments.json');
    }
}
