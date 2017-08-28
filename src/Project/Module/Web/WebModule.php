<?php

namespace Project\Module\Web;

use OU\ZendExpressive\Module\Common\Middleware\RequestLoggerMiddleware;
use OU\ZendExpressive\Module\ModuleAbstract;
use Project\Module\Web\Action\AboutAction;
use Project\Module\Web\Action\HomepageAction;
use Zend\Expressive\AppFactory;

class WebModule extends ModuleAbstract
{
    public function run()
    {
        $app = AppFactory::create($this->container);
        $app->pipe(RequestLoggerMiddleware::class);
        $app->get('/', HomepageAction::class);
        $app->get('/about', AboutAction::class);
        $app->pipeRoutingMiddleware();
        $app->pipeDispatchMiddleware();
        $app->run();
    }
}
