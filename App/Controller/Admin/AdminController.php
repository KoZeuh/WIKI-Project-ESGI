<?php

namespace App\Controller\Admin;

use App\Model\Repository\ArticleRepository;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\TagArticleRepository;
use App\Model\Repository\TagRepository;
use App\Model\Repository\UserRepository;
use App\Model\Repository\VersionRepository;
use DateTime;

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
        $nbArticles = ArticleRepository::getInstance()->getNbArticles();
        $nbUsers = UserRepository::getInstance()->getNbUsers();
        $nbVersions = VersionRepository::getInstance()->getNbVersions();
        $nbTags = TagRepository::getInstance()->getNbTags();
//        $nbComments = CommentsReposity::getInstance()->getNbComments();
        include_once './App/Templates/admin/index.php';
    }

    public function articles()
    {
        $articles = ArticleRepository::getInstance()->getArticles();
        $formattedArticles = [];
        $tagsList = TagRepository::getInstance()->getTags();

        foreach ($articles as $articleEntity) {
            $articleId = $articleEntity->getId();
            $articleLastValidVersionEntity = VersionRepository::getInstance()->getLastVersionByArticleId($articleId);


            if ($articleLastValidVersionEntity) {
                $createdAt = new DateTime($articleEntity->getCreatedAt());
                $updatedAt = new DateTime($articleLastValidVersionEntity->getUpdatedAt());

                $formattedArticles[] = [
                    'article' => $articleEntity,
                    'version' => $articleLastValidVersionEntity,
                    'countOfVersions' => VersionRepository::getInstance()->getCountVersionsByArticleId($articleId),
                    'tags' => TagArticleRepository::getInstance()->getTagsByArticleId($articleId),
                    'createdByUsername' => UserRepository::getInstance()->getUsernameById($articleEntity->getUserId()),
                    'createdAt' => $createdAt->format('d/m/Y'),
                    'updatedAt' => $updatedAt->format('d/m/Y'),
                    'versions' => VersionRepository::getInstance()->getVersionsByArticleId($articleId)
                ];

            }
        }
        include_once './App/Templates/admin/articles/articles.php';
    }

    public function users()
    {
        $users = UserRepository::getInstance()->getUsers();
        include_once './App/Templates/admin/users/users.php';
    }

    public function tags()
    {
        $tags = TagRepository::getInstance()->getTags();
        include_once './App/Templates/admin/tags/tags.php';
    }

    public function comments()
    {
        $articles = ArticleRepository::getInstance()->getArticles();
        $formattedArticles = [];
        $tagsList = TagRepository::getInstance()->getTags();

        foreach ($articles as $articleEntity) {
            $articleId = $articleEntity->getId();
            $articleLastValidVersionEntity = VersionRepository::getInstance()->getLastVersionByArticleId($articleId);


            if ($articleLastValidVersionEntity) {
                $createdAt = new DateTime($articleEntity->getCreatedAt());
                $updatedAt = new DateTime($articleLastValidVersionEntity->getUpdatedAt());

                $formattedArticles[] = [
                    'article' => $articleEntity,
                    'version' => $articleLastValidVersionEntity,
                    'countOfVersions' => VersionRepository::getInstance()->getCountVersionsByArticleId($articleId),
                    'tags' => TagArticleRepository::getInstance()->getTagsByArticleId($articleId),
                    'createdByUsername' => UserRepository::getInstance()->getUsernameById($articleEntity->getUserId()),
                    'createdAt' => $createdAt->format('d/m/Y'),
                    'updatedAt' => $updatedAt->format('d/m/Y'),
                    'comments' => CommentRepository::getInstance()->getCommentsByArticleId($articleId)
                ];

            }
        }
        include_once './App/Templates/admin/comments/comments.php';
    }
}