<?php

namespace Project\Module\Api;

use OU\Module\Common\Middleware\ErrorHandlerMiddleware;
use OU\Module\Common\Middleware\RequestLoggerMiddleware;
use OU\Module\Module;
use Project\Module\Api\Action\ListUserAction;
use Project\Module\Api\Action\NotFoundAction;
use Project\Module\Api\Action\WelcomeAction;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Router\Middleware\DispatchMiddleware;
use Zend\Expressive\Router\Middleware\RouteMiddleware;

class ApiModule implements Module
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function run()
    {
        $app = $this->container->get(Application::class);
        $app->pipe(RequestLoggerMiddleware::class);
        $app->pipe(ErrorHandlerMiddleware::class);
        $app->pipe(ServerUrlMiddleware::class);

        $app->route('/api[/]', WelcomeAction::class);
        $app->route('/api/users', ListUserAction::class);

        $app->pipe(RouteMiddleware::class);
        $app->pipe(UrlHelperMiddleware::class);
        $app->pipe(DispatchMiddleware::class);
        $app->pipe(NotFoundAction::class);
        $app->run();
    }
}
