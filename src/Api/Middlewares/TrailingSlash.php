<?php

namespace Api\Middlewares;

use Api\Module;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class TrailingSlash extends Module
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();

        if ($path != '/' && substr($path, -1) == '/') {

            // Test that the route exist
            $found = false;
            $newPath = (substr($path, 0, -1));
            foreach ($this->container->get('router')->getRoutes() as $route) {
                if ($route->getPattern() == $newPath) {
                    $found = true;
                }
            }

            if (!$found) {
                $notFoundHandler = $this->container->get('notFoundHandler');
                return $notFoundHandler($request, $response);
            }

            // permanently redirect paths with a trailing slash
            // to their non-trailing counterpart
            $uri = $uri->withPath(substr($path, 0, -1));

            if ($request->getMethod() == 'GET') {
                return $response->withRedirect((string)$uri, 301);
            } else {
                return $next($request->withUri($uri), $response);
            }
        }

        return $next($request, $response);
    }
}