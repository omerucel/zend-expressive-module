<?php

namespace OU\Module;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Config\Config;
use Zend\Diactoros\ServerRequestFactory;

class ModuleDispatcher
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @param ContainerInterface $container
     * @param Config $config
     */
    public function __construct(ContainerInterface $container, Config $config)
    {
        $this->container = $container;
        $this->config = $config;
    }

    /**
     * @param ServerRequestInterface|null $request
     */
    public function dispatch(ServerRequestInterface $request = null)
    {
        if ($request == null) {
            $request = $this->container->get(ServerRequestInterface::class)();
        }
        $this->registerModules();
        $this->dispatchModule($request);
    }

    protected function registerModules()
    {
        foreach ($this->config->modules->toArray() as $pattern => $moduleClass) {
            $module = $this->container->get($moduleClass);
            if ($module instanceof ModuleRegisterInterface) {
                $module->register();
            }
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function dispatchModule(ServerRequestInterface $request)
    {
        foreach ($this->config->modules->toArray() as $pattern => $moduleClass) {
            if (preg_match('#^/?' . $pattern . '/?#', $request->getUri()->getPath(), $matches)) {
                $this->container->get($moduleClass)->run();
                break;
            }
        }
    }
}
