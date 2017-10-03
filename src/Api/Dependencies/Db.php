<?php

namespace Api\Dependencies;

use Api\Module;
use Illuminate\Database\Capsule\Manager;

class Db extends Module
{

    public function render()
    {
        $c = $this->container;
        $c['db'] = function ($c) {
            $capsule = new Manager;
            $capsule->addConnection($c['settings']['db']['mysql']);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();

            return $capsule;
        };
    }
}
