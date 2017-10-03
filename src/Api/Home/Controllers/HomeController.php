<?php

namespace Api\Home\Controllers;

use Api\Controller;
use Api\Responses\OkResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends Controller
{

    public function index(ServerRequestInterface $request, ResponseInterface $response, $arguments)
    {
        return OkResponse::send($response, ['Hello, welcome on the API']);
    }
}
