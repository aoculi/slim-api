<?php

use Api\App;
use Api\Config;

require '../vendor/autoload.php';

session_start();

$config = Config::get('settings');

$app = (new App($config))
    ->addEndpoint(Api\Home\Routes\Home::class)
    ->addEndpoint(Api\Auth\Routes\Auth::class);

$app->run();