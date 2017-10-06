<?php

namespace Api;

use Api\Interfaces\EndpointInterface;
use Psr\Container\ContainerInterface;

class AbstractEndpoint implements EndpointInterface
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
     * Route constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();
    }

    public function getApiVersion(): string
    {
        return $this->container['settings']['apiVersionPath'];
    }

    public function render(): void
    {
        // TODO: Implement render() method.
    }

    /**
     * Return Validation rules for elements in request (check: Respect/Validation)
     *
     * @return array|null
     */
    public function getValidationRules(): ?array
    {
        return [];
    }
}
