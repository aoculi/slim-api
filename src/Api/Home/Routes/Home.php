<?php

namespace Api\Home\Routes;

use Api\Home\Controllers\HomeController;
use Api\Route;

class Home extends Route
{
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
