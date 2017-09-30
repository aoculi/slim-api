<?php

namespace Api\Dependencies;

use \Slim\Flash\Messages;
use Api\Module;

class Flash extends Module
{

    public function moduleInit()
    {
        $c = $this->container;
        $c['flash'] = function () {
            return new Messages;
        };
    }
}
