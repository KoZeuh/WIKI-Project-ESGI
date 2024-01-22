<?php

namespace App\Model\Repository;

use App\Database\Database;
use App\Model\Entity\Comment;
use PDO;
use PDOException;


class CommentRepository
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

    public function getComments()
    {
        try {
            $query = "SELECT * FROM comment";
            $statement = $this->db->query($query);

            $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
            $commentsObjects = [];

            foreach ($comments as $comment) {
                $commentsObjects[] = new Comment($comment['id'], $comment['content'], $comment['createdAt'], $comment['user_id'], $comment['article_id']);
            }

            return $commentsObjects;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

    public function getComment($id)
    {
        try {
            $query = "SELECT * FROM comment WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $comment = $statement->fetch(PDO::FETCH_ASSOC);

            if ($comment) {
                return new Comment($comment['id'], $comment['content'], $comment['createdAt'], $comment['user_id'], $comment['article_id']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return null;
        }
    }

    public function addComment($content, $user_id, $article_id)
    {
        try {
            $query = "INSERT INTO comment (content, createdAt, user_id, article_id) VALUES (:content, NOW(), :user_id, :article_id)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':content', $content);
            $statement->bindParam(':user_id', $user_id);
            $statement->bindParam(':article_id', $article_id);
            $statement->execute();

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return null;
        }
    }

    public function deleteComment($id)
    {
        try {
            $query = "DELETE FROM comment WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
        }
    }

    public function getCommentsByArticleId($id)
    {
        try {
            $query = "SELECT * FROM comment WHERE article_id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
            $commentsObjects = [];

            foreach ($comments as $comment) {
                $commentsObjects[] = new Comment($comment['id'], $comment['content'], $comment['createdAt'], $comment['user_id'], $comment['article_id']);
            }

            return $commentsObjects;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }

}