<?php

namespace Tests\App;

use Api\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testhasMethods()
    {
        $exist = method_exists(Config::class, 'get');
        $this->assertTrue($exist);
    }

    public function testLoadConfig()
    {
        $config = Config::get('settings');
        $this->assertInternalType('array', $config);

        $config = Config::get('settings.php');
        $this->assertInternalType('array', $config);

        $config = Config::get('app2');
        $this->assertNull($config);
    }

    public function testDifferentPath()
    {
        $config = Config::get('settings.php', 'config');
        $this->assertInternalType('array', $config);
    }
}
