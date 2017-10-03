<?php

namespace Api;

use Api\Dependencies\Dependencies;
use Api\Middlewares\Middlewares;

class App extends \Slim\App
{

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
     * Active all modules
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
            $route = new $class($this);
            if (method_exists($route, 'render')) {
                $route->render();
            }
        }

        return $this;
    }
}
