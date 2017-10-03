<?php

use Api\App;
use Api\Config;

require '../vendor/autoload.php';

session_start();

$config = Config::get('settings');

$app = (new App($config))
    ->addEndpoint(Api\Auth\Routes\Auth::class)
    ->addEndpoint(Api\Home\Routes\Home::class);

$app->run();