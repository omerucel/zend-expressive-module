<?php

namespace Project\Module\Web\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\TextResponse;

class NotFoundAction implements MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return \Psr\Http\Message\ResponseInterface|TextResponse
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new TextResponse('Not found!', 404);
    }
}
