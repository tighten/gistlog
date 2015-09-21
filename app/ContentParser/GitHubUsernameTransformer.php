<?php

namespace Gistlog\ContentParser;

class GitHubUsernameTransformer implements Transformer
{
    public function transform($content)
    {
        $pattern = '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z0-9][A-Za-z0-9\-]*)/';

        return trim(preg_replace_callback($pattern, function ($item) {
            return '<a href="http://github.com/' . trim($item[0], '@') . '" target="_blank">' . $item[0] . '</a>';
        }, $content));
    }
}
