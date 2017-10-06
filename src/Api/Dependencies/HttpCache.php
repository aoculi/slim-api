<?php

namespace Api\Dependencies;

use Api\AbstractModule;
use Slim\HttpCache\CacheProvider;

class HttpCache extends AbstractModule
{

    public function render()
    {
        $c = $this->container;
        $c['cache'] = function () {
            return new CacheProvider();
        };
    }
}
