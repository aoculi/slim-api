<?php

namespace Api\Dependencies;

use Api\Module;
use Illuminate\Database\Capsule\Manager;

class Db extends Module
{

    public function moduleInit()
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
