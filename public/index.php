<?php

use Api\App;
use Api\Config;

require dirname(__DIR__) . '/vendor/autoload.php';

if (php_sapi_name() !== 'cli') {
    session_start();
}

$config = Config::get('settings');

$app = (new App($config))
    ->addEndpoint(Api\Endpoints\Token\Endpoint::class)
    ->addEndpoint(Api\Endpoints\Home\Endpoint::class);

// Do not run the app if we are using cli
if (php_sapi_name() !== 'cli') {
    $app->run();
}
