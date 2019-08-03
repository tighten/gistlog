<?php

namespace Gistlog;

trait CachesGitHubResponses
{
    protected $cacheLength = 10;

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
