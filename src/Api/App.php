<?php

namespace Api;

use Api\Dependencies\Dependencies;
use Api\Middlewares\Middlewares;

class App extends \Slim\App
{

    /**
     * Endpoints defined in index.php
     * @var array[EndpointInterface]
     */
    private $endpoints = [];

    /**
     * Validation rules
     * @var array
     */
    private $rules = [];

    /**
     * App constructor.
     * @param array $container
     */
    public function __construct($container = [])
    {
        parent::__construct($container);

        // Get all modules
        $dependencies = (new Dependencies($this))->render();
        $middlewares = (new Middlewares($this))->render();

        // Activate all modules
        $this->activateModules($dependencies, 'dependency');
        $this->activateModules($middlewares, 'middleware');
    }


    /**
     * @param array $modules
     * @param string $type
     */
    private function activateModules(array $modules, string $type): void
    {
        if (!empty($modules)) {
            foreach ($modules as $module) {
                if (is_callable($module)) {
                    if ($type == 'middleware') {
                        $this->add($module);
                        continue;
                    }

                    call_user_func($module);
                    continue;
                }

                if (is_string($module)) {
                    if ($type == 'middleware') {
                        if (class_exists($module)) {
                            $this->add(new $module());
                            continue;
                        }
                    }

                    if (class_exists($module)) {
                        new $module($this);
                        continue;
                    }
                }
            }
        }
    }

    /**
     * @param string $class
     * @return App
     */
    public function addEndpoint(string $class): self
    {
        if (class_exists($class)) {
            $endpoint = new $class($this);

            $rules = $endpoint->getValidationRules();
            if ($rules && !empty($rules)) {
                $this->rules = array_merge($this->rules, $rules);
            }

            $this->endpoints[] = $this;

            if (method_exists($endpoint, 'render')) {
                $endpoint->render();
            }
        }

        return $this;
    }

    public function getMigrations(): array
    {
        $endpoints = $this->endpoints;
        $migrations = [];
        foreach ($endpoints as $endpoint) {
            $path = $this->getClassPath($endpoint);
            $migrationPath = $path . '/DB/migrations';
            if (is_dir($migrationPath)) {
                $migrations[] = $migrationPath;
            }
        }

        return $migrations;
    }

    public function getSeeds(): array
    {
        $endpoints = $this->endpoints;
        $seeds = [];
        foreach ($endpoints as $endpoint) {
            $path = $this->getClassPath($endpoint);
            $seedPath = $path . '/DB/seeds';
            if (is_dir($seedPath)) {
                $seeds[] = $seedPath;
            }
        }

        return $seeds;
    }

    public function getValidationRules(): ?array
    {
        return $this->rules;
    }

    /**
     * Return the path of a class
     * @param $class
     * @return string
     */
    private function getClassPath($class): string
    {
        $reflector = new \ReflectionClass($class);
        $fn = $reflector->getFileName();
        return dirname($fn);
    }
}
