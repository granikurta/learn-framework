<?php

namespace Component\Database;

use Component\Database\Drivers\Driver;
use Component\Database\Exception\DriverException;

class DatabaseManager
{
    public function __construct()
    {
    }

    private const DRIVERS = [
        'pdo_mysql' => Drivers\MysqlConfig::class,
    ];

    public static function getConnection(array $params): Connection
    {
        $driver = 'pdo_mysql';

        if (isset($params['driver'])) {
            $driver = $params['driver'];
        }
        $driver = self::createDriver($driver);
        return new Connection($params, $driver);
    }

    private static function createDriver(string $driver): Driver
    {
        if (!isset(self::DRIVERS[$driver])) {
            throw new DriverException("Driver {$driver} unknown");
        }
        $class = self::DRIVERS[$driver];
        return new $class;
    }
}