<?php

namespace Api;

use Api\Interfaces\ProviderInterface;
use Psr\Container\ContainerInterface;

class Provider implements ProviderInterface
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
     * Provider constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();
    }

    public function render(): array
    {
        // TODO: Implement render() method.
        return [];
    }
}
