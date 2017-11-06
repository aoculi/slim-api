<?php

require './public/index.php';

$migrations = $app->getMigrations();
$seeds = $app->getseeds();

return [
    'paths' => [
        'migrations' => $migrations,
        'seeds' => $seeds
    ],
    'environments' => [
        'default_database' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host' => $app->getContainer()->get('settings')['db']['mysql']['host'],
            'name' => $app->getContainer()->get('settings')['db']['mysql']['database'],
            'user' => $app->getContainer()->get('settings')['db']['mysql']['username'],
            'pass' => $app->getContainer()->get('settings')['db']['mysql']['password'],
            'charset' => $app->getContainer()->get('settings')['db']['mysql']['charset']
        ],
        'testing' => [
            'adapter' => 'sqlite',
            'memory' => true,
            'name' => 'testing'
        ]
    ]
];