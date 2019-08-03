<?php

namespace App\ContentParser;

use Illuminate\Support\Facades\Facade;

class ContentParserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ContentParser::class;
    }
}
