<?php

namespace Api\Endpoints\Token\Routes;

use Api\Endpoints\Token\Controllers\TokenController;
use Api\Route;

class Token extends Route
{
    protected $migration = null;
    protected $seed = null;

    public function render(): void
    {
        $app = $this->app;
        $app->group(
            $this->getApiVersion() .'/token',
            function () {
                $this->post('', TokenController::class . ':index');
            }
        );
    }
}
