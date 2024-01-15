<?php

namespace App\Model\Repository;

use App\Database\Database;
use PDO;
use PDOException;

class ArticleRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getArticles()
    {
        try {
            $query = "SELECT * FROM article";
            $statement = $this->db->query($query);

            $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $articles;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function getArticlesOfTheMonth()
    {
        try {
            $query = "SELECT * FROM article WHERE createdAt >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
            $statement = $this->db->query($query);

            $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $articles;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function getArticle($id)
    {
        try {
            $query = "SELECT * FROM article WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $article = $statement->fetch(PDO::FETCH_ASSOC);

            return $article;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function addArticle($article)
    {
        try {
            $query = "INSERT INTO article (createdAt, tags, user_id) VALUES (:created_at, :tags, :user_id)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':created_at', $article['createdAt']);
            $statement->bindParam(':tags', $article['tags']);
            $statement->bindParam(':user_id', $article['user_id']);
            $statement->execute();

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function getRandomArticle()
    {
        try {
            $query = "SELECT * FROM article ORDER BY RAND() LIMIT 1";
            $statement = $this->db->query($query);

            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }
}