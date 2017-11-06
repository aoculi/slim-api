<?php

namespace Api\Dependencies;

use Api\AbstractModule;
use Illuminate\Database\Capsule\Manager;

class Db extends AbstractModule
{

    public function render()
    {
        $c = $this->container;
        $c['db'] = function ($c) {
            $capsule = new Manager;
            $capsule->addConnection($c['settings']['db']);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;
        };
    }
}
