<?php

trait GistFixtureHelpers
{
    private function loadFixture($path)
    {
        return json_decode(file_get_contents(base_path() . '/tests/fixtures/gists/' . $path), true);
    }

    // Someone please help me name this
    private function loadNonJsonFixture($path)
    {
        return trim(file_get_contents(base_path() . '/tests/fixtures/gists/' . $path));
    }
}
