<?php
/**
 * Return Slim App settings for phpunit environment
 */

return [
    'settings' => [
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'determineRouteBeforeAppMiddleware' => true,

        'debug' => true,// Enable whoops
        'whoops.editor' => 'sublime', // Support click to open editor
        'displayErrorDetails' => true,// Display call stack in original slim error when debug is off
    ],
];