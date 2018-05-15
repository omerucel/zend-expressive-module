<?php

namespace OU\Factory\Doctrine;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\DriverManager;

class ConnectionFactory
{
    /**
     * @param \PDO $pdo
     * @return Connection
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function factory(\PDO $pdo): Connection
    {
        return DriverManager::getConnection(['pdo' => $pdo]);
    }
}
