<?php

$dotenv = new Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

$env = getenv('ENVIRONMENT') ?: 'production';

$path = __DIR__ . '/environments/' . $env . '.php';
$commonPath = __DIR__ . '/environments/common.php';

if (file_exists($path)) {
    $data = require $path;
    $common = require $commonPath;
    $data['settings'] = array_merge($data['settings'], $common);
    return $data;
}
return null;
