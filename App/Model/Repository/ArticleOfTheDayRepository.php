<?php

namespace App\Model\Repository;

use App\Database\Database;
use PDO;
use PDOException;

class articleOfTheDayRepository
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getArticlesOfTheDay()
    {
        try {
            $articleRepository = new ArticleRepository();
    
            $dateOfTheDay = date('Y-m-d');
    
            // Vérifier si des articles existent déjà pour la date actuelle
            $query = "SELECT * FROM articleOfTheDay WHERE date = :date ORDER BY date DESC LIMIT 2";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':date', $dateOfTheDay);
            $statement->execute();
            $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            if (empty($articles)) {
                // Aucun article pour la date actuelle, en récupérer deux aléatoires
                $query = "SELECT * FROM article ORDER BY RAND() LIMIT 2";
                $statement = $this->db->prepare($query);
                $statement->execute();
                $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
    
                // Insérer les articles dans la table articleOfTheDay
                foreach ($articles as $article) {
                    $query = "INSERT INTO articleOfTheDay (date, id_article) VALUES (:date, :id)";
                    $statement = $this->db->prepare($query);
                    $statement->bindParam(':date', $dateOfTheDay);
                    $statement->bindParam(':id', $article['id']);
                    $statement->execute();
                }
            }
    
            // Récupérer les articles à partir de leurs identifiants
            $articleIds = array_column($articles, 'id_article');
            $result = [];
    
            foreach ($articleIds as $articleId) {
                $result[] = $articleRepository->getArticle($articleId);
            }
    
            return $result;
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }
    
}