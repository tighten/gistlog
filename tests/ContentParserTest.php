<?php

use Gistlog\ContentParser\ContentParser;
use Gistlog\ContentParser\Transformer;

class ContentParserTest extends TestCase
{
    /** @test */
    public function it_runs_transformers_in_order()
    {
        $parser = new ContentParser;

        $parser->push(new TrimTransformer);
        $parser->push(new SpacePadTransformer);

        $this->assertEquals(" padded ", $parser->transform('padded'));

        $parser = new ContentParser;

        $parser->push(new SpacePadTransformer);
        $parser->push(new TrimTransformer);

        $this->assertEquals("trimmed", $parser->transform('trimmed'));
    }
}

class TrimTransformer implements Transformer
{
    public function transform($content)
    {
        return trim($content);
    }
}

class SpacePadTransformer implements Transformer
{
    public function transform($content)
    {
        return " {$content} ";
    }
}
