<?php

namespace App\Model\Repository;

use App\Database\Database;
use App\Model\Entity\Article;
use App\Model\Entity\Tag;
use PDO;
use PDOException;

class TagArticleRepository
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

    public function getTagsByArticleId($articleId)
    {
        try {
            $query = $this->db->prepare('SELECT tag_id, name FROM tag_article INNER JOIN tag ON tag_article.tag_id = tag.id WHERE article_id = :articleId');
            $query->execute(['articleId' => $articleId]);
            $query = $query->fetchAll(PDO::FETCH_ASSOC);

            $tagsObjects = [];

            foreach ($query as $tag) {
                $tagsObjects[] = new Tag($tag['tag_id'], $tag['name']);
            }

            return $tagsObjects;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getArticlesByTagId($tagId)
    {
        try {
            $query = $this->db->prepare('SELECT * FROM tag_article WHERE tag_id = :tagId');
            $query->execute(['tagId' => $tagId]);
            $query = $query->fetchAll(PDO::FETCH_ASSOC);

            $articlesObjects = [];

            foreach ($query as $article) {
                $articlesObjects[] = new Article($article['article_id'], $article['createdAt'], $article['user_id']);
            }

            return $articlesObjects;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getArticlesByTagName($tagName)
    {
        try {
            $query = $this->db->prepare('SELECT * FROM tag_article WHERE tag_id = (SELECT id FROM tag WHERE name = :tagName)');
            $query->execute(['tagName' => $tagName]);
            $query = $query->fetchAll(PDO::FETCH_ASSOC);

            $articlesObjects = [];

            foreach ($query as $article) {
                $articlesObjects[] = new Article($article['article_id'], $article['createdAt'], $article['user_id']);
            }

            return $articlesObjects;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addTagArticle($articleId, $tagId)
    {
        try {
            $query = "INSERT INTO tag_article (article_id, tag_id) VALUES (:articleId, :tagId)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':articleId', $articleId);
            $statement->bindParam(':tagId', $tagId);
            $statement->execute();
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
        }
    }

    public function deleteAllTagByArticleId($articleId)
    {
        try {
            $query = "DELETE FROM tag_article WHERE article_id = :articleId";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':articleId', $articleId);
            $statement->execute();
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
        }
    }
}