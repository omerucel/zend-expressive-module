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
            \OU\Logger\LoggerHelper::class => \DI\factory([\OU\Logger\LoggerHelperFactory::class, 'create'])
        ]
    ],
    'logger' => [
        'default_name' => 'app',
        'path' => $basePath . '/var/logs',
        'level' => \Psr\Log\LogLevel::DEBUG
    ],
    'modules' => [
        '/api' => \Project\Module\Api\ApiModule::class,
        '/panel' => \Project\Module\Panel\PanelModule::class,
        '/' => \Project\Module\Web\WebModule::class
    ]
];
