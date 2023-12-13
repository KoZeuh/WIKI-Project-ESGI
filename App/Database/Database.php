<?php

namespace App\Database;

class Database
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        // Configurations de connexion à la base de données
        $host = 'localhost';
        $dbname = 'esgi_wiki';
        $username = 'root';
        $password = 'root';

        // Création de la connexion à la base de données
        $this->connection = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
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
