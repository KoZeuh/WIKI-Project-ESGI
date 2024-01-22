<?php

namespace App\Model\Repository;

use App\Database\Database;
use App\Model\Entity\Tag;
use PDO;
use PDOException;

class TagRepository
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
    public function __clone()
    {
    }

    // Empêche la désérialisation de l'objet
    public function __wakeup()
    {
    }

    public function getTags()
    {
        try {
            $query = $this->db->prepare('SELECT * FROM tag');
            $query->execute();
            $query = $query->fetchAll(PDO::FETCH_ASSOC);

            $tagsObjects = [];

            foreach ($query as $tag) {
                $tagsObjects[] = new Tag($tag['id'], $tag['name']);
            }

            return $tagsObjects;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getTagById($id)
    {
        try {
            $query = "SELECT * FROM tag WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $tag = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$tag) {
                return null;
            }

            return new Tag($tag['id'], $tag['name']);
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }


    public function getNbTags()
    {
        try {
            $query = "SELECT COUNT(*) FROM tag";
            $statement = $this->db->query($query);
            $statement = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$statement) {
                return 0;
            }

            return $statement['COUNT(*)'];
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function deleteTag($id)
    {
        try {
            $query = "DELETE FROM tag WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return false;
        }
    }

    public function editTag($tag)
    {
        try {
            $query = "UPDATE tag SET name = :name WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $tag['id']);
            $statement->bindParam(':name', $tag['name']);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return false;
        }
    }
}