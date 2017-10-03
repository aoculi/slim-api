<?php

namespace Api\Auth\Controllers;

use Api\Controller;
use Api\Responses\CreatedResponse;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends Controller
{

    public function index(ServerRequestInterface $request, ResponseInterface $response, $arguments)
    {
        $server = $request->getServerParams();

        $now = new \DateTime();
        $future = new \DateTime("now +2 hours");
        $jti = bin2hex(random_bytes(16)); // uniqueId

        //$jti = (new Base62)->encode(random_bytes(16));
        //$scope = [];

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "sub" => $server["PHP_AUTH_USER"],
            //  "scope" => $scopes
        ];

        // Create token
        $secret = $this->container['settings']['jwt'];
        $token = JWT::encode($payload, $secret, "HS256");

        $data = [
            'token' => $token,
            'expires' => $future->getTimeStamp()
        ];

        return CreatedResponse::send($response, $data);
    }
}
