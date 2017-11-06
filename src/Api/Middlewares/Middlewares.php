<?php

namespace Api\Middlewares;

use Api\AbstractProvider;
use Api\Responses\UnAuthorizedResponse;
use DavidePastore\Slim\Validation\Validation;
use Slim\HttpCache\Cache;
use Slim\Middleware\HttpBasicAuthentication;
use Slim\Middleware\JwtAuthentication;
use Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware;

class Middlewares extends AbstractProvider
{

    public function render(): array
    {
        $app = $this->app;

        if ($this->container->get('settings')["displayErrorDetails"]) {
            $modules[] = new WhoopsMiddleware($app);
        }

        $modules[] = new TrailingSlash($app);


        // Use to check user credential on /token page
        // TODO: relaxed and secure need to be managed in config file
        $modules[] = new HttpBasicAuthentication(
            [
                "path" => ['/v1/token'],
                "secure" => false,
                "users" => [
                    "admin" => $this->container->get('settings')['adminPassword']
                ],
                //"relaxed" => ["192.168.50.52", "127.0.0.1", "localhost"],
                "error" => function ($request, $response, $arguments) {
                    return UnAuthorizedResponse::send($response, $arguments['message']);
                }
            ]
        );

        // User to check user token on all pages expect on the /token page
        // TODO: relaxed and secure need to be managed in config file
        $modules[] = new JwtAuthentication(
            [
                "path" => '/',
                "passthrough" => ['/v1/token'],
                "secure" => false,
                "secret" => $this->container->get('settings')['jwt'],
                // "logger" => $container["logger"],
                "attribute" => false,
                "algorithm" => ["HS256"],
                //"relaxed" => ["192.168.50.52", "127.0.0.1", "localhost"],
                "error" => function ($request, $response, $arguments) {
                    return UnAuthorizedResponse::send($response, $arguments['message']);
                }
            ]
        );

        // TODO: Improve settings, check here -> https://www.slimframework.com/docs/features/caching.html
        // TODO: implement 304 Not Modified response
        $modules[] = new Cache('public', 86400);

        // Get all validations rules from all registered endpoints -> https://github.com/DavidePastore/Slim-Validation
        $validators = $app->getValidationRules();
        $modules[] = new Validation($validators);

        return $modules;
    }
}
