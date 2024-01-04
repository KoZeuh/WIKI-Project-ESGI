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

    public function getArticleOfTheDay()
    {
        try {
            $articleRepository = new ArticleRepository();
            $query = "SELECT * FROM articleOfTheDay ORDER BY date DESC LIMIT 1";
            $statement = $this->db->prepare($query);
            $statement->execute();
            $article = $statement->fetch(PDO::FETCH_ASSOC);

            $dateOfTheDay = date('Y-m-d');
            if ($article['date'] != $dateOfTheDay) {
                $query = "SELECT * FROM article ORDER BY RAND() LIMIT 1";
                $statement = $this->db->prepare($query);
                $statement->execute();
                $article = $statement->fetch(PDO::FETCH_ASSOC);

                $query = "INSERT INTO articleOfTheDay (date, id_article) VALUES (:date, :id)";
                $statement = $this->db->prepare($query);
                $statement->bindParam(':date', $dateOfTheDay);
                $statement->bindParam(':id', $article['id']);
                $statement->execute();
            }

            return $articleRepository->getArticle($article['id_article']);
        } catch (PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }
}