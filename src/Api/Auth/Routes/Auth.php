<?php

namespace Api\Auth\Routes;

use Api\Auth\Controllers\AuthController;
use Api\Route;

class Auth extends Route
{
    public function render(): void
    {
        $app = $this->app;
        $app->group(
            '/v1/auth',
            function () {
                $this->post('', AuthController::class . ':index');
            }
        );
    }
}
