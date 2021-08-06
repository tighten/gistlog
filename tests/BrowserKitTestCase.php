<?php

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

class BrowserKitTestCase extends BaseTestCase
{
    protected $baseUrl = 'http://localhost';

    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }
}
