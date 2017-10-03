<?php

namespace Api\Dependencies;

use Api\Module;
use Api\Responses\InternalServerErrorResponse;

class PhpErrorHandler extends Module
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
