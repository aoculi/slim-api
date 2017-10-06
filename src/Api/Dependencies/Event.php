<?php

namespace Api\Dependencies;

use League\Event\Emitter;
use Api\AbstractModule;

class Event extends AbstractModule
{

    public function render()
    {
        $c = $this->container;
        $c['events'] = function () {
            return new Emitter();
        };
    }
}
