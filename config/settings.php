<?php

$dotenv = new Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

$env = getenv('ENVIRONMENT') ?: 'production';

$path = __DIR__ . '/environments/' . $env . '.php';
if (file_exists($path)) {
    $file = require $path;
    return $file;
}
return null;
