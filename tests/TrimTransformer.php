<?php

use App\ContentParser\Transformer;

class TrimTransformer implements Transformer
{
    public function transform($content)
    {
        return trim($content);
    }
}
