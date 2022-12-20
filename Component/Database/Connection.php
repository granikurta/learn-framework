<?php

namespace Component\Database;

use Component\Database\Drivers\Driver;

class Connection
{
    private Driver $driver;

    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }
}