<?php

namespace {

    use OU\Console\Helper\Doctrine\ConfigurationHelper;
    use OU\Factory\ContainerFactory;
    use OU\Console\Helper\ContainerHelper;
    use Symfony\Component\Console\Application;
    use Zend\Config\Config;

    $basePath = realpath(dirname(__DIR__));
    $environment = getenv('APPLICATION_ENV');
    $configPath = $basePath . '/app/configs';
    include_once($basePath . '/vendor/autoload.php');

    $container = ContainerFactory::factory($environment, $configPath);
    $config = $container->get(Config::class);
    $config->logger->default_name = 'console';

    $app = new Application();
    $app->add(new Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand());
    $app->add(new Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand());
    $app->getHelperSet()->set($container->get(ContainerHelper::class));
    $app->getHelperSet()->set($container->get(ConfigurationHelper::class));
    $app->run();
}
