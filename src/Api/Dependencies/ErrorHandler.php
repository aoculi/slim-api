<?php

namespace Api\Dependencies;

use Api\Module;
use Api\Responses\InternalServerErrorResponse;

class ErrorHandler extends Module
{

    public function moduleInit()
    {
        $c = $this->container;
        $c['errorHandler'] = function ($c) {
            return function ($request, $response, $exception) use ($c) {
                return InternalServerErrorResponse::send($c['response']);
            };
        };
    }
}