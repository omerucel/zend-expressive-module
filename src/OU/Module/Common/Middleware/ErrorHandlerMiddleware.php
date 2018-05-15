<?php

namespace OU\Module\Common\Middleware;

use OU\Logger\LoggerHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\TextResponse;

class ErrorHandlerMiddleware implements MiddlewareInterface
{
    /**
     * @var LoggerHelper
     */
    protected $loggerHelper;

    /**
     * @param LoggerHelper $loggerHelper
     */
    public function __construct(LoggerHelper $loggerHelper)
    {
        $this->loggerHelper = $loggerHelper;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $requestHandler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $requestHandler): ResponseInterface
    {
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            if (!(error_reporting() & $errno)) {
                return;
            }
            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
        try {
            return $requestHandler->handle($request);
        } catch (\Throwable $exception) {
        }
        $this->loggerHelper->getDefaultLogger()->error($exception);
        restore_error_handler();
        return new TextResponse('An error occurred!');
    }
}
