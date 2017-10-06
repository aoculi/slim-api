<?php
/**
 * Created by PhpStorm.
 * User: aoculi
 * Date: 02/10/2017
 * Time: 23:03
 */

namespace Api;

use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Controller constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
