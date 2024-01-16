<?php

namespace App\Model\Repository;

use App\Database\Database;
use PDO;
use PDOException;

class ArticleOfTheDayRepository
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

    public function getArticlesOfTheDay()
    {
        try {
            $articleRepository = ArticleRepository::getInstance();
    
            $dateOfTheDay = date('Y-m-d');
    
            // Vérifier si des articles existent déjà pour la date actuelle
            $query = "SELECT * FROM articleOfTheDay WHERE date = :date ORDER BY date DESC LIMIT 2";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':date', $dateOfTheDay);
            $statement->execute();
            $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            if (empty($articles)) {
                // Aucun article pour la date actuelle, en récupérer deux aléatoires valides
                $query = "SELECT * FROM version_article va
                          JOIN article a ON va.article_id = a.id
                          WHERE va.isValid = 1
                          ORDER BY RAND() LIMIT 2";
                $statement = $this->db->prepare($query);
                $statement->execute();
                $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
    
                // Insérer les articles dans la table articleOfTheDay
                foreach ($articles as $article) {
                    $query = "INSERT INTO articleOfTheDay (date, article_id) VALUES (:date, :id)";
                    $statement = $this->db->prepare($query);
                    $statement->bindParam(':date', $dateOfTheDay);
                    $statement->bindParam(':id', $article['id']);
                    $statement->execute();
                }
            }
    
            // Récupérer les articles à partir de leurs identifiants
            $articleIds = array_column($articles, 'article_id');
            $result = [];
    
            foreach ($articleIds as $articleId) {
                $result[] = $articleRepository->getArticleById($articleId);
            }
    
            return $result;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }
    
    
}