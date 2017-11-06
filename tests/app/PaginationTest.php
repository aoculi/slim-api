<?php

namespace Tests\App;

use Tests\SlimFrameworkTestCase;

class PaginationTest extends SlimFrameworkTestCase
{
    private static $token = '';

    public function init()
    {
        // Get token
        $path = '/v1/token';
        $headers = [
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => getenv('ADMIN_PASSWORD')
        ];
        $response = $this->post($path, [], $headers);
        $response = json_decode((string)$response->getBody());
        self::$token = $response->token;
    }

    public function testResponseHasNoPagination()
    {
        //$this->migrateAndSeedDB();
        /**
         * create dummy table with 105 elements
         * mock controller
         * verify
         */
    }

    public function testResponseHasPagination()
    {
    }
}
