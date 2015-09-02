<?php namespace Gistlog\ContentParser;

use Stauros\Stauros;

class XssCleaner implements Transformer
{
    public function transform($content)
    {
        return (new Stauros)->scanHTML($content);
    }
}
