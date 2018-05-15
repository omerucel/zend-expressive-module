<?php

$basePath = realpath(dirname(dirname(__DIR__)));

error_reporting(E_ALL);
ini_set('error_log', $basePath . '/var/logs/php_error.log');
ini_set('display_errors', false);
date_default_timezone_set('Europe/Istanbul');

return [
    'basePath' => $basePath,
    'php_di' => [
        'definitions' => [
            /**
             * Application
             */
            PDO::class => \DI\factory([\OU\Factory\PdoFactory::class, 'factory']),
            \OU\Logger\LoggerHelper::class => \DI\factory([\OU\Logger\LoggerHelperFactory::class, 'create']),
            Twig_Environment::class => \DI\factory([\OU\Factory\TwigFactory::class, 'factory']),
            \Doctrine\DBAL\Migrations\Configuration\Configuration::class => \DI\factory([\OU\Factory\Doctrine\Migration\ConfigurationFactory::class, 'factory']),
            \Doctrine\DBAL\Driver\Connection::class => \DI\factory([\OU\Factory\Doctrine\ConnectionFactory::class, 'factory']),

            /**
             * Zend Expressive
             */
            \Zend\Expressive\Application::class => \DI\factory([\Zend\Expressive\Container\ApplicationFactory::class, '__invoke']),
            'Zend\Expressive\ApplicationPipeline' => \DI\factory([\Zend\Expressive\Container\ApplicationPipelineFactory::class, '__invoke']),
            \Zend\HttpHandlerRunner\Emitter\EmitterInterface::class => \DI\factory([\Zend\Expressive\Container\EmitterFactory::class, '__invoke']),
            \Zend\Stratigility\Middleware\ErrorHandler::class => \DI\factory([\Zend\Expressive\Container\ErrorHandlerFactory::class, '__invoke']),
            \Zend\Expressive\Handler\NotFoundHandler::class => \DI\factory([\Zend\Expressive\Container\NotFoundHandlerFactory::class, '__invoke']),
            \Zend\Expressive\MiddlewareContainer::class => \DI\factory([\Zend\Expressive\Container\MiddlewareContainerFactory::class, '__invoke']),
            \Zend\Expressive\MiddlewareFactory::class => \DI\factory([\Zend\Expressive\Container\MiddlewareFactoryFactory::class, '__invoke']),
            \Zend\Expressive\Middleware\ErrorResponseGenerator::class => \DI\factory([\Zend\Expressive\Container\ErrorResponseGeneratorFactory::class, '__invoke']),
            \Zend\HttpHandlerRunner\RequestHandlerRunner::class => \DI\factory([\Zend\Expressive\Container\RequestHandlerRunnerFactory::class, '__invoke']),
            \Psr\Http\Message\ResponseInterface::class => \DI\factory([\Zend\Expressive\Container\ResponseFactoryFactory::class, '__invoke']),
            \Zend\Expressive\Response\ServerRequestErrorResponseGenerator::class => \DI\factory([\Zend\Expressive\Container\ServerRequestErrorResponseGeneratorFactory::class, '__invoke']),
            \Psr\Http\Message\ServerRequestInterface::class => \DI\factory([\Zend\Expressive\Container\ServerRequestFactoryFactory::class, '__invoke']),
            \Psr\Http\Message\StreamInterface::class => \DI\factory([\Zend\Expressive\Container\StreamFactoryFactory::class, '__invoke']),

            /**
             * Router
             */
            \Zend\Expressive\Router\RouterInterface::class => \DI\factory([\Zend\Expressive\Router\FastRouteRouterFactory::class, '__invoke'])
        ]
    ],
    'modules' => [
        '/api' => \Project\Module\Api\ApiModule::class,
        '/panel' => \Project\Module\Panel\PanelModule::class,
        '/' => \Project\Module\Web\WebModule::class
    ],
    'pdo' => [
        'dsn' => 'mysql:host=mysql;dbname=database;charset=utf8',
        'username' => 'root',
        'password' => ''
    ],
    'logger' => [
        'default_name' => 'app',
        'path' => $basePath . '/var/logs',
        'level' => \Psr\Log\LogLevel::DEBUG
    ],
    'twig' => [
        'default_template_path' => $basePath . '/app/templates',
        'assets_url' => '',
        'assets_version' => 1,
        'globals' => [],
        'options' => [
            'auto_reload' => true,
            'cache' => $basePath . '/var/cache/twig'
        ]
    ],
    'doctrine' => [
        'migration' => [
            'name' => 'Project',
            'namespace' => 'Project\Database\Migration',
            'table_name' => 'migration',
            'directory' => $basePath . '/src/Project/Database/Migration'
        ]
    ]
];
