<?php

namespace Gistlog\ContentParser;

use Michelf\MarkdownExtra;

class MarkdownTransformer implements Transformer
{
    public function transform($content)
    {
        return MarkdownExtra::defaultTransform($content);
    }
}
