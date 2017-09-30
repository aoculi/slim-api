<?php

namespace Api\Middlewares;

use Api\Provider;
use Slim\HttpCache\Cache;
use Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware;

class Middlewares extends Provider
{

    public function get(): array
    {
        $app = $this->app;

        if ($this->container->get('settings')["displayErrorDetails"]) {
            $modules[] = new WhoopsMiddleware($app);
        }

        $modules[] = new TrailingSlash($app);

        // TODO: https://www.slimframework.com/docs/features/caching.html
        $modules[] = new Cache('public', 86400);

        return $modules;
    }
}