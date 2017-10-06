<?php

namespace Api\Endpoints\Home;

use Api\Endpoints\Home\Controllers\HomeController;
use Api\AbstractEndpoint;

class Endpoint extends AbstractEndpoint
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
