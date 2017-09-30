<?php

namespace Api\Dependencies;

use Api\Module;
use Slim\HttpCache\CacheProvider;

class HttpCache extends Module
{

    public function moduleInit()
    {
        $c = $this->container;
        $c['cache'] = function () {
            return new CacheProvider();
        };
    }
}