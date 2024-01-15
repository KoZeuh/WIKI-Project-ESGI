<?php

namespace App\Model\Repository;

use App\Database\Database;
use PDO;
use PDOException;

class VersionRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getVersions($id)
    {
        try {
            $query = "SELECT * FROM version_article WHERE article_id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $versions = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $versions;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function getVersion($id)
    {
        try {
            $query = "SELECT * FROM version_article WHERE article_id = :id ORDER BY updatedAt DESC LIMIT 1";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $version = $statement->fetch(PDO::FETCH_ASSOC);

            return $version;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
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
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
        }
    }

    public function updateVersion($version)
    {
        try {
            $query = "UPDATE version_article SET title = :title, isValid = :isValid, content = :content, updatedAt = :updatedAt, article_id = :article_id, user_id = :user_id WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $version['id']);
            $statement->bindParam(':title', $version['title']);
            $statement->bindParam(':isValid', $version['isValid']);
            $statement->bindParam(':content', $version['content']);
            $statement->bindParam(':updatedAt', $version['updatedAt']);
            $statement->bindParam(':article_id', $version['article_id']);
            $statement->bindParam(':user_id', $version['user_id']);
            $statement->execute();
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
}