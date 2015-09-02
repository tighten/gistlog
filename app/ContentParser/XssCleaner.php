<?php namespace Gistlog\ContentParser;

use Stauros\HTML\Config;
use Stauros\Stauros;

class XssCleaner implements Transformer
{
    public function transform($content)
    {
        $config = new Config;
        $config->tagWhiteList = array_merge($config->tagWhiteList, [
            'code' => ['class' => true],
            'pre' => [],
        ]);
        return (new Stauros($config))->scanHTML($content);
    }
}
