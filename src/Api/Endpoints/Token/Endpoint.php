<?php

namespace Api\Endpoints\Token;

use Api\AbstractEndpoint;
use Api\Endpoints\Token\Controllers\TokenController;

class Endpoint extends AbstractEndpoint
{

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
