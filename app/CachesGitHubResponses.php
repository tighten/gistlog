<?php

namespace App;

trait CachesGitHubResponses
{
    protected $cacheLength = 600;

    /**
     * @param string $method
     * @param string $data
     * @return string
     */
    public static function cacheKey($method, $data = null)
    {
        if ($data) {
            $method .= "::{$data}";
        }

        return $method;
    }
}
