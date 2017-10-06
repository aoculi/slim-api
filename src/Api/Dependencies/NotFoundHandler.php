<?php

namespace Api\Dependencies;

use Api\AbstractModule;
use Api\Responses\NotFoundResponse;

class NotFoundHandler extends AbstractModule
{

    public function render()
    {
        $c = $this->container;
        $c['notFoundHandler'] = function ($c) {
            return function ($request, $response) use ($c) {
                return NotFoundResponse::send($c['response']);
            };
        };
    }
}
