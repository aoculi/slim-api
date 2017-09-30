<?php

namespace Tests;

use Api\Responses\OkResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use \Api\App;
use \Api\Config;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class BaseCase extends TestCase
{
    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @param array|null $files the files that we want to upload
     * @return ResponseInterface
     */
    public function runApp($requestMethod, $requestUri, $requestData = null, $files = null)
    {

        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();


        $config = Config::get('settings');

        $app = (new App($config))
            ->addEndpoint(\Api\Home\Routes\Home::class);

        // Create a fake route for testing
        $app->get(
            '/phpunit',
            function ($request, $response) {
                return OkResponse::send($response, ['Yea']);
            }
        );

        // Process the application
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }

    /**
     * Need this to avoid this error
     * 1) Warning
     * No tests found in class "Tests\BaseCase".
     */
    public function testTrue()
    {
        $this->assertTrue(true, true);
    }
}
