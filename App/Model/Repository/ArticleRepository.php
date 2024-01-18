<?php

namespace App\Model\Repository;

use App\Database\Database;
use App\Model\Entity\Article;
use PDO;
use PDOException;

class ArticleRepository
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

    public function getArticles()
    {
        try {
            $query = "SELECT * FROM article";
            $statement = $this->db->query($query);

            $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
            $articlesObjects = [];

            foreach ($articles as $article) {
                $articlesObjects[] = new Article($article['id'], $article['createdAt'], $article['user_id']);
            }

            return $articlesObjects;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function getArticlesOfTheMonth()
    {
        try {
            $query = "SELECT * FROM article WHERE createdAt >= DATE_SUB(NOW(), INTERVAL 1 MONTH) LIMIT 9";
            $statement = $this->db->query($query);

            $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
            $articlesObjects = [];

            foreach ($articles as $article) {
                $articlesObjects[] = new Article($article['id'], $article['createdAt'], $article['user_id']);
            }


            return $articlesObjects;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function getArticleById($id)
    {
        try {
            $query = "SELECT * FROM article WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $article = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$article) {
                return null;
            }

            return new Article($article['id'], $article['createdAt'], $article['user_id']);
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

            return new Article($this->db->lastInsertId(), $article['createdAt'], $article['user_id']);
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
            $statement = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$statement) {
                return [];
            }

            return new Article($statement['id'], $statement['createdAt'], $statement['user_id']);
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function getNbArticles()
    {
        try {
            $query = "SELECT COUNT(*) FROM article";
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
}