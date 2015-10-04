<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    protected $baseUrl = 'http://localhost';

    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    protected function checkRequirements()
    {
        parent::checkRequirements();

        $annotations = $this->getAnnotations();

        foreach (array('class', 'method') as $depth) {
            if (empty($annotations[$depth]['requires'])) {
                continue;
            }

            $requires = array_flip($annotations[$depth]['requires']);

            if (isset($requires['!Travis']) && getenv('TRAVIS') === '1') {
                $this->markTestSkipped('This test does not run on Travis.');
            }
        }
    }
}
