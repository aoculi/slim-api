<?php

namespace Tests\App\Middlewares;

use Tests\SlimFrameworkTestCase;

class AuthTest extends SlimFrameworkTestCase
{

    private static $token = '';

    public function testTokenRouteWhithoutCredentials()
    {
        $path = '/v1/token';
        $response = $this->post($path);
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testTokenRouteWithBadCredentials()
    {
        $path = '/v1/token';
        $headers = [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'badPass'
        ];
        $response = $this->post($path, [], $headers);
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testTokenRouteWithGoodCredentials()
    {
        $path = '/v1/token';
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
        $path = '/testing';
        $response = $this->get($path);
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testRouteWhithToken()
    {
        $token = self::$token;
        $path = '/testing';
        $headers = [
            'HTTP_Authorization' => "Bearer $token"
        ];
        $response = $this->get($path, [], $headers);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
