<?php

namespace App\Controller\Admin;

use App\Model\Entity\Article;
use App\Model\Repository\ArticleRepository;

class AdminController
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'ROLE_ADMIN') {
            header('Location: /login');
            exit();
        }
    }

    public function index()
    {
        include_once './App/Templates/admin/index.php';
    }

    public function articles()
    {
        $articles = ArticleRepository::getInstance()->getArticles();
        $articlesAsObjects = [];
        foreach ($articles as $article) {
            $articlesAsObjects[] = new Article($article->getId(), $article->getCreatedAt(), $article->getUserId());
        }
        include_once './App/Templates/admin/articles/articles.php';
    }
}