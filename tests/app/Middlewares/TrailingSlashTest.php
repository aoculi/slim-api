<?php

namespace Tests\App\Middlewares;

use Tests\BaseCase;

class AppTest extends BaseCase
{

    public function testExistingUrlWithNoEndingSlash()
    {
        $path = '/phpunit';
        $response = $this->runApp('GET', $path);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testExistingUrlWithEndingSlash()
    {
        $path = '/phpunit/';
        $response = $this->runApp('GET', $path);
        $this->assertEquals(301, $response->getStatusCode());

        $location = $response->getHeader('Location')[0];
        $this->assertTrue(substr($location, -1) != '/');
    }

    public function testNotExistingUrlWithNoEndingSlash()
    {
        $path = '/fake-route-with-slash';
        $response = $this->runApp('GET', $path);
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testNotExistingUrlWithEndingSlash()
    {
        $path = '/fake-route-with-slash/';
        $response = $this->runApp('GET', $path);
        $this->assertEquals(404, $response->getStatusCode());
    }
}
