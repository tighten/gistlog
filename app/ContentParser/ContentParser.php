<?php namespace Gistlog\ContentParser;

class ContentParser
{
    protected $transformers;

    public function push(Transformer $transformer)
    {
        $this->transformers[] = $transformer;
    }

    public function transform($content)
    {
        return array_reduce($this->transformers, function ($content, $transformer) {
            return $transformer->transform($content);
        }, $content);
    }
}
