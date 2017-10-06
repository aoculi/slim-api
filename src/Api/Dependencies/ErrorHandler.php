<?php

namespace Api\Dependencies;

use Api\AbstractModule;
use Api\Responses\InternalServerErrorResponse;

class ErrorHandler extends AbstractModule
{

    public function render()
    {
        $c = $this->container;
        $c['errorHandler'] = function ($c) {
            return function ($request, $response, $exception) use ($c) {
                return InternalServerErrorResponse::send($c['response']);
            };
        };
    }
}
