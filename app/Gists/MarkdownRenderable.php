<?php namespace Gistlog\Gists;

use Michelf\MarkdownExtra;

trait MarkdownRenderable {

    public function renderFromMarkdown($markdown)
    {
        $html = MarkdownExtra::defaultTransform($markdown);

        $createLinks = function ($item) {
            return '<a href="http://github.com/' . trim($item[0], '@') . '" target="_blank">' . $item[0] . '</a>';
        };

        return trim(preg_replace_callback('/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z0-9]+)/', $createLinks, $html));
    }
}
