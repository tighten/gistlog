<?php

class BrowserKitTestCase extends Laravel\BrowserKitTesting\TestCase
{
    protected $baseUrl = 'http://localhost';

    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
