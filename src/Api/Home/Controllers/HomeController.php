<?php

namespace Api\Home\Controllers;

use Api\Responses\OkResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{

    public function index(ServerRequestInterface $request, ResponseInterface $response, $arguments)
    {
        return OkResponse::send($response, ['Hello, welcome on the API']);
    }
}
