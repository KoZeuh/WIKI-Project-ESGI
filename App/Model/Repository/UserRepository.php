<?php

namespace App\Model\Repository;

use App\Model\Entity\User;

use App\Database\Database;

class UserRepository
{
    private static $instance;
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Empêche le clonage de l'objet
    public function __clone() {}

    // Empêche la désérialisation de l'objet
    public function __wakeup() {}

    public function registerUser($email, $username, $firstname, $lastname, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $query = "INSERT INTO user (email, username, firstname, lastname, password) VALUES (:email, :username, :firstname, :lastname, :password)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':firstname', $firstname);
            $statement->bindParam(':lastname', $lastname);
            $statement->bindParam(':password', $hashedPassword);
            $statement->execute();

            return $this->getUserByUsername($username);
        } catch (\PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return null;
        }
    }

    public function getUserByUsername($username)
    {
        try {
            $query = "SELECT * FROM user WHERE username = :username";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':username', $username);
            $statement->execute();

            $user = $statement->fetch(\PDO::FETCH_ASSOC);

            if (!$user) {
                return null;
            }

            $userEntity = new User(
                $user['id'],
                $user['email'],
                $user['username'],
                $user['firstname'],
                $user['lastname'],
                $user['password'],
                $user['role']
            );

            return $userEntity;
        } catch (\PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return null;
        }
    }

    public function getUserByUsernameAndPassword($username, $password)
    {
        try {
            $user = $this->getUserByUsername($username);

            if ($user && password_verify($password, $user->getPassword())) {
                return $user;
            }

            return null;
        } catch (\PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return null;
        }
    }

    public function getUsers()
    {
        try {
            $query = "SELECT * FROM user";
            $statement = $this->db->query($query);

            $users = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $usersObjects = [];

            foreach ($users as $user) {
                $usersObjects[] = new User(
                    $user['id'],
                    $user['email'],
                    $user['username'],
                    $user['firstname'],
                    $user['lastname'],
                    $user['password'],
                    $user['role']
                );
            }

            return $usersObjects;
        } catch (\PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function getUsernameById($id)
    {
        try {
            $query = "SELECT username FROM user WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $user = $statement->fetch(\PDO::FETCH_ASSOC);

            return $user['username'];
        } catch (\PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return null;
        }
    }
}
