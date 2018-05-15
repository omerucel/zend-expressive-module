<?php

namespace OU\Factory;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;
use Zend\Expressive\Router\RouteCollector;
use Zend\HttpHandlerRunner\RequestHandlerRunner;
use Zend\Stratigility\MiddlewarePipe;

class ApplicationFactory
{
    public static function factory(ContainerInterface $container)
    {
        return new Application(
            $container->get(MiddlewareFactory::class),
            $container->get(MiddlewarePipe::class),
            $container->get(RouteCollector::class),
            $container->get(RequestHandlerRunner::class)
        );
    }
}
