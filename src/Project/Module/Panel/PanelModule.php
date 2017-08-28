<?php

namespace Project\Module\Panel;

use OU\ZendExpressive\Module\Common\Middleware\RequestLoggerMiddleware;
use OU\ZendExpressive\Module\ModuleAbstract;
use Project\Module\Panel\Action\HomepageAction;
use Project\Module\Panel\Action\LoginAction;
use Zend\Expressive\AppFactory;

class PanelModule extends ModuleAbstract
{
    public function run()
    {
        $app = AppFactory::create($this->container);
        $app->pipe(RequestLoggerMiddleware::class);
        $app->route('/panel/login', LoginAction::class);
        $app->route('/panel[/]', HomepageAction::class);
        $app->pipeRoutingMiddleware();
        $app->pipeDispatchMiddleware();
        $app->run();
    }
}
