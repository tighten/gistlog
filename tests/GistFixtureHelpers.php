<?php

trait GistFixtureHelpers
{
    private function loadFixture($path)
    {
        return json_decode(file_get_contents(base_path() . '/tests/fixtures/gists/' . $path), true);
    }
}
