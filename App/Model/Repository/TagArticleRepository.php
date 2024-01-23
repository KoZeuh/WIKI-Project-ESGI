<?php

namespace App\Model\Repository;

use App\Database\Database;
use App\Model\Entity\Article;
use App\Model\Entity\Tag;
use App\Model\Entity\Version;
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

    public function getVersionArticleByTagIg($tagIg)
    {
        try {
            $query = "
                SELECT version_article.*
                FROM version_article
                JOIN article ON version_article.article_id = article.id
                JOIN tag_article ON article.id = tag_article.article_id
                JOIN tag ON tag_article.tag_id = tag.id
                WHERE tag.id = :tagId;
            ";

            $statement = $this->db->prepare($query);
            $statement->bindParam(':tagId', $tagIg);
            $statement->execute();

            $versionArticlesData = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (!$versionArticlesData) {
                return [];
            }

            $versionArticles = [];
            foreach ($versionArticlesData as $versionArticleData) {
                $versionArticles[] = new Version(
                    $versionArticleData['id'],
                    $versionArticleData['title'],
                    $versionArticleData['isValid'],
                    $versionArticleData['content'],
                    $versionArticleData['updatedAt'],
                    $versionArticleData['article_id'],
                    $versionArticleData['user_id'],
                );
            }

            return $versionArticles;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
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