<?php namespace Gistlog\Gists;

use Michelf\MarkdownExtra;

trait MarkdownRenderable {

    public function render($html)
    {
        $md = MarkdownExtra::defaultTransform($html);

        $link = function ($item) {
            return '<a href="http://github.com/' . trim($item[0], '@') . '" target="_blank">' . $item[0] . '</a>';
        };

        return preg_replace_callback('/(@\w+)/', $link, $md);
    }
}