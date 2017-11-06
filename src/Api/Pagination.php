<?php

namespace Api;


use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class Pagination
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * @var AbstractModel
     */
    private $model;

    /**
     * Pagination constructor.
     * @param App $app
     * @param ServerRequestInterface $request
     * @param AbstractModel $model
     */
    public function __construct(App $app, ServerRequestInterface $request, AbstractModel $model)
    {
        $this->app = $app;
        $this->container = $app->getContainer();
        $this->request = $request;
        $this->model = $model;
    }

    public function get(): array
    {
        // TODO: Manage errors + Documentation

        $offset = $this->request->getParam('offset') ?: 0;
        $limit = $this->container->get('settings')['requestLimit'] ?: 10;
        $total = $this->model->count();

        $elements = $this->model->orderBy('created_at', 'desc');
        $elements = $elements->skip($offset)->take($limit);
        $elements = $elements->get();

        $per_page = $elements->count();

        // Calculating offset values
        $offset_prev = (($offset - $limit) < 0) ? null : $offset - $limit;
        $offset_last = floor($total / $limit);
        $offset_next = (($offset + $limit) > $offset_last) ? null : $offset + $limit;

        $result = [];

        // Defining Pagination array data
        $result['pagination'] = [
            'offset' => $offset,
            'limit' => $limit,
            'per_page' => $per_page,
            'total' => $total
        ];

        // Defining Urls
        $uri = $this->request->getUri();
        $url = $uri['scheme'] . '://' . $uri['host'] . $uri['path'];
        $url_with_args = $url . '?' . $uri['query'];

        // Defining Links array data
        $result['links'] = [];
        $result['links']['self'] = $url_with_args;
        $result['links']['first'] = $url;
        $result['links']['last'] = $url . '?offset=' . $offset_last;
        $result['links']['prev'] = null;
        $result['links']['next'] = null;

        if (!is_null($offset_prev)) {
            $result['links']['prev'] = $url . '?offset=' . $offset_prev;
        }
        if (!is_null($offset_next)) {
            $result['links']['next'] = $url . '?offset=' . $offset_next;
        }

        return $result;
    }
}