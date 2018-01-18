<?php

namespace Project\Module\Web;

use OU\ZendExpressive\Module\Common\Middleware\ErrorHandlerMiddleware;
use OU\ZendExpressive\Module\Common\Middleware\RequestLoggerMiddleware;
use OU\ZendExpressive\Module\ModuleAbstract;
use Project\Module\Web\Action\AboutAction;
use Project\Module\Web\Action\HomepageAction;
use Project\Module\Web\Action\NotFoundAction;
use Zend\Expressive\AppFactory;
use Zend\Expressive\Router\RouterInterface;

class WebModule extends ModuleAbstract
{
    public function run()
    {
        $app = AppFactory::create($this->container, $this->container->get(RouterInterface::class));
        $app->pipe(RequestLoggerMiddleware::class);
        $app->pipe(ErrorHandlerMiddleware::class);
        $app->route('/', HomepageAction::class)->setName('homepage');
        $app->route('/about', AboutAction::class)->setName('about');
        $app->pipeRoutingMiddleware();
        $app->pipeDispatchMiddleware();
        $app->pipe(NotFoundAction::class);
        $app->run();
    }
}
