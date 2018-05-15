<?php

namespace Project\Module\Web;

use OU\Module\Common\Middleware\ErrorHandlerMiddleware;
use OU\Module\Common\Middleware\RequestLoggerMiddleware;
use OU\Module\Module;
use Project\Module\Web\Action\AboutAction;
use Project\Module\Web\Action\HomepageAction;
use Project\Module\Web\Action\NotFoundAction;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Helper\ServerUrlMiddleware;
use Zend\Expressive\Helper\UrlHelperMiddleware;
use Zend\Expressive\Router\Middleware\DispatchMiddleware;
use Zend\Expressive\Router\Middleware\RouteMiddleware;

class WebModule implements Module
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

        $app->route('/', HomepageAction::class)->setName('homepage');
        $app->route('/about', AboutAction::class)->setName('about');

        $app->pipe(RouteMiddleware::class);
        $app->pipe(UrlHelperMiddleware::class);
        $app->pipe(DispatchMiddleware::class);
        $app->pipe(NotFoundAction::class);
        $app->run();
    }
}
