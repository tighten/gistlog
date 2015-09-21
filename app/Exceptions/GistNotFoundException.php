<?php

namespace Gistlog\Exceptions;

class GistNotFoundException extends \Exception
{
    public $gistId;

    public function __construct($gistId, $message)
    {
        $this->gistId = $gistId;
        parent::__construct("Failed to retrieve Gist '{$gistId}': {$message}");
    }
}
