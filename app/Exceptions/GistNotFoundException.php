<?php

namespace App\Exceptions;

use Exception;

class GistNotFoundException extends Exception
{
    public $gistId;

    public function __construct($gistId, $message)
    {
        $this->gistId = $gistId;

        parent::__construct("Failed to retrieve Gist '{$gistId}': {$message}");
    }
}
