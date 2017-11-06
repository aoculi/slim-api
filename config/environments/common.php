<?php

$settings = [
    'apiVersionPath' => '/v1',
    'environment' => getenv('ENVIRONMENT') ?: 'production',
    'adminPassword' => getenv('ADMIN_PASSWORD'),
    'jwt' => getenv('JWT_SECRET'),
    'db' => [
        'driver' => getenv('DB_DRIVER'),
        'host' => getenv('DB_HOST'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'charset' => getenv('DB_CHARSET'),
        'collation' => getenv('DB_COLLATION'),
        'prefix' => getenv('DB_PREFIX')
    ]
];

// Use SQLite::memory: for testing
if (getenv('ENVIRONMENT') == 'testing') {
    $settings['db'] = [
        'driver' => 'sqlite',
        'database' => ':memory:'
    ];
}

return $settings;