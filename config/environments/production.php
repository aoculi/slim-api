<?php
/**
 * Return Slim App settings for production environment
 */
return [
    'settings' => [
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'determineRouteBeforeAppMiddleware' => true,

        'debug' => false,// Enable whoops
        'whoops.editor' => 'sublime', // Support click to open editor
        'displayErrorDetails' => false,// Display call stack in original slim error when debug is off
    ],
];