<?php

namespace App\Database;

use PDO;

class Database
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        $host = 'localhost';
        $dbname = 'esgi_wiki';
        $username = 'root';
        $password = 'root';

        $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
