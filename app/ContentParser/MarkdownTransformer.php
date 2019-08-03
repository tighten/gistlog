<?php

namespace App\ContentParser;

use Michelf\MarkdownExtra;

class MarkdownTransformer implements Transformer
{
    public function transform($content)
    {
        return MarkdownExtra::defaultTransform($content);
    }
}
