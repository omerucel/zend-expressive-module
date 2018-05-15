<?php

namespace OU\Module\Common\Middleware;

use OU\ClientIPAddressFinder;
use OU\Logger\LoggerHelper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestLoggerMiddleware implements MiddlewareInterface
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
        $message = 'New ' . $request->getMethod() . ' request for ' . strval($request->getUri());
        $this->loggerHelper->getDefaultLogger()->info(
            $message,
            [
                'post_params' => $request->getParsedBody(),
                'client_ip' => ClientIPAddressFinder::find($request->getServerParams()),
                'server_ip' => $request->getServerParams()['SERVER_ADDR'] ?? ''
            ]
        );
        return $requestHandler->handle($request);
    }
}
