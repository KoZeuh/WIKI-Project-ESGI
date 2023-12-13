<?php

namespace App\Model\Repository;

use \App\Database\Database;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getUsers()
    {
        try {
            $query = "SELECT * FROM user";
            $statement = $this->db->query($query);

            $user = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $user;
        } catch (\PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }
}
