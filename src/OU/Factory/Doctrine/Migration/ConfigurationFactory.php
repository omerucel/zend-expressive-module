<?php

namespace OU\Factory\Doctrine\Migration;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Zend\Config\Config;

class ConfigurationFactory
{
    /**
     * @param Config $config
     * @param Connection $connection
     * @return Configuration
     */
    public static function factory(Config $config, Connection $connection): Configuration
    {
        $configuration = new Configuration($connection);
        $configuration->setName($config->doctrine->migration->name);
        $configuration->setMigrationsNamespace($config->doctrine->migration->namespace);
        $configuration->setMigrationsTableName($config->doctrine->migration->table_name);
        $configuration->setMigrationsDirectory($config->doctrine->migration->directory);
        return $configuration;
    }
}
