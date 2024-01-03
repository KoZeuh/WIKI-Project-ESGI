<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Model\Repository\ArticleRepository;

class AdminController
{
    public function index()
    {
        include_once './App/Templates/admin/index.php';
    }

    public function articles()
    {
        $articles = new ArticleRepository();
        $articles = $articles->getArticles();
        $articlesAsObjects = [];
        foreach ($articles as $article) {
            $articlesAsObjects[] = new Article($article['id'], $article['createdAt'], $article['tags']);
        }
        include_once './App/Templates/admin/articles/articles.php';
    }
}