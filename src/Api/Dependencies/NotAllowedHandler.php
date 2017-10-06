<?php

namespace Api\Dependencies;

use Api\AbstractModule;
use Api\Responses\MethodNotAllowedResponse;

class NotAllowedHandler extends AbstractModule
{

    public function render()
    {
        $c = $this->container;
        $c['notAllowedHandler'] = function ($c) {
            return function ($request, $response, $methods) use ($c) {
                return MethodNotAllowedResponse::send(
                    $c['response'],
                    'Method must be one of: ' . implode(', ', $methods),
                    405,
                    $methods
                );
            };
        };
    }
}
