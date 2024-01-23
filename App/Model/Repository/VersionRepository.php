<?php

namespace App\Model\Repository;

use App\Database\Database;
use App\Model\Entity\Version;
use PDO;
use PDOException;

class VersionRepository
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

    public function getVersionsByArticleId($id)
    {
        try {
            $query = "SELECT * FROM version_article WHERE article_id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $versions = $statement->fetchAll(PDO::FETCH_ASSOC);
            $versionsObjects = [];

            foreach ($versions as $version) {
                $versionsObjects[] = new Version($version['id'], $version['title'], $version['isValid'], $version['content'], $version['updatedAt'], $version['article_id'], $version['user_id']);
            }

            return $versionsObjects;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function getCountVersionsByArticleId($id)
    {
        try {
            $query = "SELECT COUNT(*) FROM version_article WHERE article_id = :id AND isValid = 1";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $count = $statement->fetch(PDO::FETCH_ASSOC);

            return $count['COUNT(*)'];
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return 0;
        }
    }

    public function getLastVersionByArticleId($id)
    {
        try {
            $query = "SELECT * FROM version_article WHERE article_id = :id ORDER BY updatedAt DESC LIMIT 1";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $version = $statement->fetch(PDO::FETCH_ASSOC);
            $versionObject = new Version($version['id'], $version['title'], $version['isValid'], $version['content'], $version['updatedAt'], $version['article_id'], $version['user_id']);

            return $versionObject;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
        }

        return null;
    }

    public function addVersion($version)
    {
        try {
            $query = "INSERT INTO version_article (title, isValid, content, updatedAt, article_id, user_id) VALUES (:title, :isValid, :content, :updatedAt, :article_id, :user_id)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':title', $version['title']);
            $statement->bindParam(':isValid', $version['isValid']);
            $statement->bindParam(':content', $version['content']);
            $statement->bindParam(':updatedAt', $version['updatedAt']);
            $statement->bindParam(':article_id', $version['article_id']);
            $statement->bindParam(':user_id', $version['user_id']);
            $statement->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
        }
    }

    public function deleteVersion($id)
    {
        try {
            $query = "DELETE FROM version_article WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
        }
    }

    public function getNbVersions()
    {
        try {
            $query = "SELECT COUNT(*) FROM version_article";
            $statement = $this->db->query($query);
            $statement = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$statement) {
                return 0;
            }

            return $statement['COUNT(*)'];
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return 0;
        }
    }

    public function validateVersion($id)
    {
        try {
            $query = "UPDATE version_article SET isValid = 1 WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
        }
    }

    public function unvalidateVersion($id)
    {
        try {
            $query = "UPDATE version_article SET isValid = 0 WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
        }
    }

    public function getArticleIdByVersionId($id)
    {
        try {
            $query = "SELECT article_id FROM version_article WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $articleId = $statement->fetch(PDO::FETCH_ASSOC);

            return $articleId['article_id'];
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return 0;
        }
    }
}