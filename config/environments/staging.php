<?php
/**
 * Return Slim App settings for staging environment
 */
return [
    'settings' => [
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'determineRouteBeforeAppMiddleware' => true,

        'debug' => true,// Enable whoops
        'whoops.editor' => 'sublime', // Support click to open editor
        'displayErrorDetails' => true,// Display call stack in orignal slim error when debug is off

        'environment' => 'development',

        // Databases
        'db' => [
            'mysql' => [
                'driver' => getenv('DB_DRIVER'),
                'host' => getenv('DB_HOST'),
                'database' => getenv('DB_DATABASE'),
                'username' => getenv('DB_USERNAME'),
                'password' => getenv('DB_PASSWORD'),
                'charset' => getenv('DB_CHARSET'),
                'collation' => getenv('DB_COLLATION'),
                'prefix' => getenv('DB_PREFIX')
            ]
        ]
    ],
];