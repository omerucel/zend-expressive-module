<?php

namespace {

    use OU\Factory\ContainerFactory;
    use OU\ZendExpressive\Module\ModuleDispatcher;

    $basePath = realpath(dirname(__DIR__));
    $environment = getenv('APPLICATION_ENV');
    $configPath = $basePath . '/app/configs';

    include_once($basePath . '/vendor/autoload.php');

    $container = ContainerFactory::factory($environment, $configPath);
    ($container->get(ModuleDispatcher::class))->dispatch();
}
