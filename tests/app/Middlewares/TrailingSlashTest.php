<?php

namespace Tests\App\Middlewares;

use Tests\SlimFrameworkTestCase;

class TrailingSlashTest extends SlimFrameworkTestCase
{
    private static $token = '';

    public function init()
    {
        // Get token
        $path = '/v1/auth';
        $headers = [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => getenv('ADMIN_PASSWORD')
        ];
        $response = $this->post($path, [], $headers);
        $response = json_decode((string)$response->getBody());
        self::$token = $response->token;
    }

    public function testExistingUrlWithNoEndingSlash()
    {
        $this->init();
        $path = '/phpunit';
        $headers = ['HTTP_Authorization' => 'Bearer ' . self::$token];
        $response = $this->get($path, [], $headers);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testExistingUrlWithEndingSlash()
    {
        $path = '/phpunit/';
        $headers = ['HTTP_Authorization' => 'Bearer ' . self::$token];
        $response = $this->get($path, [], $headers);
        $this->assertEquals(301, $response->getStatusCode());

        $location = $response->getHeader('Location')[0];
        $this->assertTrue(substr($location, -1) != '/');
    }

    public function testNotExistingUrlWithNoEndingSlash()
    {
        $path = '/fake-route-with-slash';
        $headers = ['HTTP_Authorization' => 'Bearer ' . self::$token];
        $response = $this->get($path, [], $headers);
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testNotExistingUrlWithEndingSlash()
    {
        $path = '/fake-route-with-slash/';
        $headers = ['HTTP_Authorization' => 'Bearer ' . self::$token];
        $response = $this->get($path, [], $headers);
        $this->assertEquals(404, $response->getStatusCode());
    }
}
