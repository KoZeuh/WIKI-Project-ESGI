<?php

namespace App\Controller;

use \App\DAL

class ArticleController
{
    public function index()
    {
        // Créer une instance du DAL
        $dal = new DAL();

        // Utiliser le DAL pour interagir avec la base de données
        $data = $dal->fetchArticles(); // Exemple imaginaire

        var_dump($data);
    }
}
