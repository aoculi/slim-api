<?php

namespace Api\Endpoints\Home\Routes;

use Api\Endpoints\Home\Controllers\HomeController;
use Api\Route;

class Home extends Route
{
    protected $migration = null;
    protected $seed = null;

    public function render(): void
    {
        $app = $this->app;
        $app->group(
            '/',
            function () {
                $this->get('', HomeController::class . ':index');
            }
        );
    }
}
