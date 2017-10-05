<?php

namespace Api;

use Api\Interfaces\ModuleInterface;
use Psr\Container\ContainerInterface;

abstract class Module implements ModuleInterface
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Module constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();

        if (method_exists($this, 'render')) {
            $this->render();
        }
    }
}
