<?php

namespace Api\Dependencies;

use Api\Module;
use Api\Responses\NotFoundResponse;

class NotFoundHandler extends Module
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
