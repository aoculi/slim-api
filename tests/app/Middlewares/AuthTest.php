<?php

namespace Tests\App\Middlewares;

use Tests\SlimFrameworkTestCase;

class AuthTest extends SlimFrameworkTestCase
{

    private static $token = '';

    public function testAuthRouteWhithoutCredentials()
    {
        $path = '/v1/auth';
        $response = $this->post($path);
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testAuthRouteWithBadCredentials()
    {
        $path = '/v1/auth';
        $headers = [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'badPass'
        ];
        $response = $this->post($path, [], $headers);
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testAuthRouteWithGoodCredentials()
    {
        $path = '/v1/auth';
        $headers = [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => getenv('ADMIN_PASSWORD')
        ];
        $response = $this->post($path, [], $headers);
        $this->assertEquals(201, $response->getStatusCode());

        $response = json_decode((string)$response->getBody());
        $this->assertNotEmpty($response->token);
        self::$token = $response->token;
    }

    public function testRouteWhitoutToken()
    {
        $path = '/phpunit';
        $response = $this->get($path);
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testRouteWhithToken()
    {
        $token = self::$token;
        $path = '/phpunit';
        $headers = [
            'HTTP_Authorization' => "Bearer $token"
        ];
        $response = $this->get($path, [], $headers);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
