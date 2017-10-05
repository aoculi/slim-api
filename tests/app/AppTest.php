<?php

namespace Tests\App;

use Tests\SlimFrameworkTestCase;

class AppTest extends SlimFrameworkTestCase
{
    public function testhasMethodsGetMigationDirectories()
    {
        require './public/index.php';

        $exist = method_exists($app, 'getMigrations');
        $this->assertTrue($exist);
    }

    public function testhasMethodsGetSeedDirectories()
    {
        require './public/index.php';

        $exist = method_exists($app, 'getSeeds');
        $this->assertTrue($exist);
    }
}
