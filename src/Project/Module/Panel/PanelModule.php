<?php

namespace Project\Module\Panel;

use OU\Module\Common\Middleware\ErrorHandlerMiddleware;
use OU\Module\Common\Middleware\RequestLoggerMiddleware;
use OU\Module\Module;
use Project\Module\Panel\Action\HomepageAction;
use Project\Module\Panel\Action\LoginAction;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Router\Middleware\DispatchMiddleware;
use Zend\Expressive\Router\Middleware\RouteMiddleware;

class PanelModule implements Module
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

        $app->route('/panel/login', LoginAction::class)->setName('login');
        $app->route('/panel[/]', HomepageAction::class)->setName('homepage');

        $app->pipe(RouteMiddleware::class);
        $app->pipe(UrlHelperMiddleware::class);
        $app->pipe(DispatchMiddleware::class);
        $app->run();
    }
}
