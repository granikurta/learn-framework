<?php

namespace Test\Component\Database;

use Component\Database\DatabaseManager;
use Component\Database\Connection;
use Component\Database\Exception\DriverException;
use PHPUnit\Framework\TestCase;

class DatabaseManagerTest extends TestCase
{

    public function testGetConnection()
    {
        $params = [
            'driver' => 'pdo_mysql',
            'user' => '123',
            'password' => 'asd'
        ];
        $conn = DatabaseManager::getConnection($params);

        $this->assertInstanceOf(Connection::class, $conn);
    }

    public function testGetConnectionUnknownDriverException()
    {
        $params = [
            'driver' => 'test_mysql',
            'user' => '123',
            'password' => 'asd'
        ];
        $this->expectException(DriverException::class);
        DatabaseManager::getConnection($params);
    }
}
