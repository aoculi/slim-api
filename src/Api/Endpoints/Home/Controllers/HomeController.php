<?php

namespace Api\Endpoints\Home\Controllers;

use Api\AbstractController;
use Api\Responses\OkResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends AbstractController
{

    public function index(ServerRequestInterface $request, ResponseInterface $response, $arguments)
    {
        return OkResponse::send($response, ['Hello, welcome on the API']);
    }
}
