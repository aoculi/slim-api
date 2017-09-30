<?php

namespace Api;


use Psr\Container\ContainerInterface;

class Route
{
    /**
     * @var callable
     */
    public $app;

    /**
     * @var ContainerInterface
     */
    public $container;

    /**
     * Provider constructor.
     * @param callable $app
     */
    public function __construct(callable $app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();
    }
}