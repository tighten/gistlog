<?php namespace Gistlog\ContentParser;

class GitHubUsernameTransformer implements Transformer
{
    public function transform($content)
    {
        $pattern = '/\B@(?!\-)[a-zA-Z0-9\-]*(?![^<]*<\/a>)/';

        return trim(preg_replace_callback($pattern, function ($item) {
            return '<a href="http://github.com/' . trim($item[0], '@') . '" target="_blank">' . $item[0] . '</a>';
        }, $content));
    }
}
