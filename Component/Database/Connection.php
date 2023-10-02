<?php

namespace Component\Database;

use Component\Database\Drivers\Driver;
use Component\Database\Drivers\MysqlConfig;

class Connection
{
    private Driver $driver;

    public function __construct(MysqlConfig $driver)
    {
        $this->driver = $driver;
    }
}