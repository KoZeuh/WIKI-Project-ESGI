<?php

namespace App\Controller;

use DateTime;

use App\Model\Repository\ArticleRepository;
use App\Model\Repository\UserRepository;
use App\Model\Repository\VersionRepository;
use App\Model\Repository\TagArticleRepository;
use App\Model\Repository\TagRepository;

class ArticleController
{
    public function list()
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
                    'tags' => TagArticleRepository::getInstance()->getTagsByArticleId($articleId),
                    'createdByUsername' => UserRepository::getInstance()->getUsernameById($articleEntity->getUserId()),
                    'createdAt' => $createdAt->format('d/m/Y'),
                    'updatedAt' => $updatedAt->format('d/m/Y')
                ];
            }
        }
        $pageTitle = 'Liste des articles';
        include_once './App/Templates/articles/list.php';
    }
    
    public function show($articleId)
    {
        $articleEntity = ArticleRepository::getInstance()->getArticleById($articleId);

        if (!$articleEntity) {
            header('Location: /article/list');
            return;
        }

        $formattedArticle = [
            'article' => $articleEntity,
            'lastVersion' => VersionRepository::getInstance()->getLastVersionByArticleId($articleId),
            'versions' => VersionRepository::getInstance()->getVersionsByArticleId($articleId),
            'tags' => TagArticleRepository::getInstance()->getTagsByArticleId($articleId),
            'createdByUsername' => UserRepository::getInstance()->getUsernameById($articleEntity->getUserId())
        ];

        $pageTitle = 'Détails d\'un article';
        include_once './App/Templates/articles/show.php';
    }

}

