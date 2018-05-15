<?php

namespace OU\Factory;

use Zend\Config\Config;

class PdoFactory
{
    public static function factory(Config $config)
    {
        $pdoConfigs = $config->pdo;
        $pdo = new \PDO($pdoConfigs->dsn, $pdoConfigs->username, $pdoConfigs->password);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
