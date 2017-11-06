<?php
namespace Tests;

use Api\Responses\OkResponse;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\RequestBody;
use Slim\Http\Response;
use Slim\Http\Uri;
use Phinx\Config\Config;
use Phinx\Migration\Manager;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;

class SlimFrameworkTestCase extends TestCase
{
    /** @var \Slim\App */
    public $app;

    /** @var ContainerInterface */
    protected $container;

    /** @var  \Slim\Http\Request */
    public $request;

    /** @var  \Slim\Http\Response */
    public $response;

    private $cookies = [];

    // Run for each unit test to setup our slim app environment
    public function setup()
    {
        require './public/index.php';

        // Create a fake route for testing
        $app->get(
            '/testing',
            function ($request, $response) {
                return OkResponse::send($response, ['Yea']);
            }
        );

        $this->app = $app;
        $this->container = $app->getContainer();
    }

    public function migrateAndSeedDB(){
        $pdo = $this->container->get('db')->getConnection()->getPdo();
        $configArray = require('phinx.php');
        $configArray['environments']['testing']['connection'] = $pdo;
        $config = new Config($configArray);
        $manager = new Manager($config, new StringInput(' '), new NullOutput());
        $manager->migrate('testing');
        $manager->seed('testing');
    }

    public function __call($method, $arguments)
    {
        throw new \BadMethodCallException(strtoupper($method) . ' is not supported');
    }

    public function get($path, $data = [], $optionalHeaders = [])
    {
        return $this->request('get', $path, $data, $optionalHeaders);
    }

    public function post($path, $data = [], $optionalHeaders = [])
    {
        return $this->request('post', $path, $data, $optionalHeaders);
    }

    public function patch($path, $data = [], $optionalHeaders = [])
    {
        return $this->request('patch', $path, $data, $optionalHeaders);
    }

    public function put($path, $data = [], $optionalHeaders = [])
    {
        return $this->request('put', $path, $data, $optionalHeaders);
    }

    public function delete($path, $data = [], $optionalHeaders = [])
    {
        return $this->request('delete', $path, $data, $optionalHeaders);
    }

    public function head($path, $data = [], $optionalHeaders = [])
    {
        return $this->request('head', $path, $data, $optionalHeaders);
    }

    public function options($path, $data = [], $optionalHeaders = [])
    {
        return $this->request('options', $path, $data, $optionalHeaders);
    }

    // Abstract way to make a request to SlimPHP, this allows us to mock the
    // slim environment
    private function request($method, $path, $data = [], $optionalHeaders = [])
    {
        //Make method uppercase
        $method = strtoupper($method);
        $options = [
            'REQUEST_METHOD' => $method,
            'REQUEST_URI'    => $path
        ];

        if ($method === 'GET') {
            $options['QUERY_STRING'] = http_build_query($data);
        } else {
            $params  = json_encode($data);
        }

        // Prepare a mock environment
        $env = Environment::mock(array_merge($options, $optionalHeaders));
        $uri = Uri::createFromEnvironment($env);
        $headers = Headers::createFromEnvironment($env);
        $cookies = $this->cookies;
        $serverParams = $env->all();
        $body = new RequestBody();

        // Attach JSON request
        if (isset($params)) {
            $headers->set('Content-Type', 'application/json;charset=utf8');
            $body->write($params);
        }

        $this->request  = new Request($method, $uri, $headers, $cookies, $serverParams, $body);
        $response = new Response();

        // Process request
        $app = $this->app;
        $this->response = $app->process($this->request, $response);

        // Return the application output.
        return $this->response;
    }

    public function setCookie($name, $value)
    {
        $this->cookies[$name] = $value;
    }
}
