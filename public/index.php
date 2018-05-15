<?php

namespace {

    use OU\Factory\ContainerFactory;
    use OU\Module\ModuleDispatcher;

    $basePath = realpath(dirname(__DIR__));
    $environment = getenv('APPLICATION_ENV');
    $configPath = $basePath . '/app/configs';

    include_once($basePath . '/vendor/autoload.php');
    (ContainerFactory::factory($environment, $configPath))->get(ModuleDispatcher::class)->dispatch();
}
