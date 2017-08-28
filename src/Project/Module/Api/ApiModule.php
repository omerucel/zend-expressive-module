<?php

namespace Project\Module\Api;

use OU\ZendExpressive\Module\Common\Middleware\RequestLoggerMiddleware;
use OU\ZendExpressive\Module\ModuleAbstract;
use Project\Module\Api\Action\ListUserAction;
use Project\Module\Api\Action\WelcomeAction;
use Zend\Expressive\AppFactory;

class ApiModule extends ModuleAbstract
{
    public function run()
    {
        $app = AppFactory::create($this->container);
        $app->pipe(RequestLoggerMiddleware::class);
        $app->route('/api[/]', WelcomeAction::class);
        $app->route('/api/users', ListUserAction::class);
        $app->pipeRoutingMiddleware();
        $app->pipeDispatchMiddleware();
        $app->run();
    }
}
