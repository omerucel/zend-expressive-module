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
            \OU\Logger\LoggerHelper::class => \DI\factory([\OU\Logger\LoggerHelperFactory::class, 'create']),
            Twig_Environment::class => \DI\factory([\Project\Factory\TwigFactory::class, 'factory']),
            \Zend\Expressive\Router\RouterInterface::class => \DI\factory([\Zend\Expressive\Router\FastRouteRouterFactory::class, '__invoke'])
        ]
    ],
    'modules' => [
        '/api' => \Project\Module\Api\ApiModule::class,
        '/panel' => \Project\Module\Panel\PanelModule::class,
        '/' => \Project\Module\Web\WebModule::class
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
];
