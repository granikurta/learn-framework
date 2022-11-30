<?php

namespace database;

use \PDO;

class DB
{
    public static function getConnection(): PDO
    {
        $config = require('./config/Database.php');
        $db = $config['mysql']['db'];
        $host = $config['mysql']['host'];
        $pdo = new PDO('mysql:dbname=$db;host=$host', $config['mysql']['user'], $config['mysql']['password']);
        return $pdo;
    }
}