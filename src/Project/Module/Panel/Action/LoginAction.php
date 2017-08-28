<?php

namespace Project\Module\Panel\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\TextResponse;

class LoginAction implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return TextResponse
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new TextResponse(__METHOD__);
    }
}
