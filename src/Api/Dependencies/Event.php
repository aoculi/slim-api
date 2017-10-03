<?php

namespace Api\Dependencies;

use League\Event\Emitter;
use Api\Module;

class Event extends Module
{

    public function render()
    {
        $c = $this->container;
        $c['events'] = function () {
            return new Emitter();
        };
    }
}
