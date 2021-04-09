<?php

namespace App\Exceptions;

use Throwable;

class GistNotFoundException extends Throwable
{
    public $gistId;

    public function __construct($gistId, $message)
    {
        $this->gistId = $gistId;
        parent::__construct("Failed to retrieve Gist '{$gistId}': {$message}");
    }
}
