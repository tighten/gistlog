<?php

use App\ContentParser\Transformer;

class SpacePadTransformer implements Transformer
{
    public function transform($content)
    {
        return " {$content} ";
    }
}
