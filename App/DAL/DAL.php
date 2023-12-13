<?php

namespace App\DAL;

class DAL
{
    private $db;

    public function __construct()
    {
        $this->db = \App\Database\Database::getInstance()->getConnection();
    }

    public function fetchArticles()
    {
        try {
            // Utilisez une requête SQL pour récupérer les articles depuis la base de données
            $query = "SELECT * FROM article";
            $statement = $this->db->query($query); 

            // Récupérez les résultats sous forme de tableau associatif
            $articles = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $articles;
        } catch (\PDOException $e) {
            // Gérez les erreurs de la base de données ici
            echo "Erreur de la base de données : " . $e->getMessage();
            return [];
        }
    }
}
