<?php

namespace App\ContentParser;

interface Transformer
{
    public function transform($content);
}
