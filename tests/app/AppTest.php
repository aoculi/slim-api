<?php

namespace Tests\App;

use Tests\SlimFrameworkTestCase;

class AppTest extends SlimFrameworkTestCase
{
    public function testhasMethodsGetMigrations()
    {
        require './public/index.php';

        $exist = method_exists($app, 'getMigrations');
        $this->assertTrue($exist);
    }

    public function testhasMethodsGetSeeds()
    {
        require './public/index.php';

        $exist = method_exists($app, 'getSeeds');
        $this->assertTrue($exist);
    }

    public function testhasMethodsGetValidationRules()
    {
        require './public/index.php';

        $exist = method_exists($app, 'getValidationRules');
        $this->assertTrue($exist);
    }
}
