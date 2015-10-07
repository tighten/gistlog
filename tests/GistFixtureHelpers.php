<?php

trait GistFixtureHelpers
{
    private function loadJsonFixture($path)
    {
        return json_decode($this->loadFixture($path), true);
    }

    private function loadFixture($path)
    {
        return trim(file_get_contents(base_path() . '/tests/fixtures/gists/' . $path));
    }
}
