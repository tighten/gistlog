<?php

use App\ContentParser\ContentParser;

class ContentParserTest extends BrowserKitTestCase
{
    /** @test */
    public function it_runs_transformers_in_order()
    {
        $parser = new ContentParser();

        $parser->push(new TrimTransformer());
        $parser->push(new SpacePadTransformer());

        $this->assertEquals(' padded ', $parser->transform('padded'));

        $parser = new ContentParser();

        $parser->push(new SpacePadTransformer());
        $parser->push(new TrimTransformer());

        $this->assertEquals('trimmed', $parser->transform('trimmed'));
    }
}
