<?php

use Api\App;
use Api\Config;

require '../vendor/autoload.php';

session_start();

$config = Config::get('settings');

$app = (new App($config))
    ->addEndpoint(Api\Endpoints\Token\Routes\Token::class)
    ->addEndpoint(Api\Endpoints\Home\Routes\Home::class);

$app->run();