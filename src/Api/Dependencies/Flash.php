<?php

namespace Api\Dependencies;

use \Slim\Flash\Messages;
use Api\AbstractModule;

class Flash extends AbstractModule
{

    public function render()
    {
        $c = $this->container;
        $c['flash'] = function () {
            return new Messages;
        };
    }
}
