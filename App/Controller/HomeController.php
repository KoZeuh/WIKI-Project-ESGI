<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Model\Repository\ArticleOfTheDayRepository;

class HomeController
{
    public function index()
    {
        $articleOfTheDayRepository = new ArticleOfTheDayRepository();
        $article = $articleOfTheDayRepository->getArticleOfTheDay();
        $article = new Article($article['id'], $article['createdAt'], $article['tags']);
        $version = $article->getLastVersion();

        $articleOfTheDay = [
            'article' => $article,
            'version' => $version
        ];

        $pageTitle = 'Accueil';
        include_once './App/Templates/home/index.php';
    }

}

