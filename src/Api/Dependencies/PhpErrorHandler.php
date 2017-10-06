<?php

namespace Api\Dependencies;

use Api\AbstractModule;
use Api\Responses\InternalServerErrorResponse;

class PhpErrorHandler extends AbstractModule
{

    public function render()
    {
        $c = $this->container;
        $c['phpErrorHandler'] = function ($c) {
            return function ($request, $response, $error) use ($c) {
                return InternalServerErrorResponse::send($c['response']);
            };
        };
    }
}
