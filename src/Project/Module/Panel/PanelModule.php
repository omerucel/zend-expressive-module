<?php

namespace Project\Module\Panel;

use OU\ZendExpressive\Module\Common\Middleware\RequestLoggerMiddleware;
use OU\ZendExpressive\Module\ModuleAbstract;
use Project\Module\Panel\Action\HomepageAction;
use Project\Module\Panel\Action\LoginAction;
use Zend\Expressive\AppFactory;
use Zend\Expressive\Router\RouterInterface;

class PanelModule extends ModuleAbstract
{
    public function run()
    {
        $app = AppFactory::create($this->container, $this->container->get(RouterInterface::class));
        $app->pipe(RequestLoggerMiddleware::class);
        $app->route('/panel/login', LoginAction::class)->setName('login');
        $app->route('/panel[/]', HomepageAction::class)->setName('homepage');
        $app->pipeRoutingMiddleware();
        $app->pipeDispatchMiddleware();
        $app->run();
    }
}
