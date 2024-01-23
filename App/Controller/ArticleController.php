<?php

namespace App\Controller;

use App\Model\Repository\ArticleRepository;
use App\Model\Repository\CommentRepository;
use App\Model\Repository\TagArticleRepository;
use App\Model\Repository\TagRepository;
use App\Model\Repository\UserRepository;
use App\Model\Repository\VersionRepository;
use DateTime;

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

            if ($articleLastValidVersionEntity && $articleLastValidVersionEntity->getIsValid()) {
                $createdAt = new DateTime($articleEntity->getCreatedAt());
                $updatedAt = new DateTime($articleLastValidVersionEntity->getUpdatedAt());

                $formattedArticles[] = [
                    'article' => $articleEntity,
                    'version' => $articleLastValidVersionEntity,
                    'countOfVersions' => VersionRepository::getInstance()->getCountVersionsByArticleId($articleId),
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
            return header('Location: /article/list');
        }

        $lastVersionEntity = VersionRepository::getInstance()->getLastVersionByArticleId($articleId);

        if (!$lastVersionEntity || !$lastVersionEntity->getIsValid()) {
            return header('Location: /article/list');
        }

        $formattedArticle = [
            'article' => $articleEntity,
            'lastVersion' => $lastVersionEntity,
            'versions' => VersionRepository::getInstance()->getVersionsByArticleId($articleId),
            'tags' => TagArticleRepository::getInstance()->getTagsByArticleId($articleId),
            'createdByUsername' => UserRepository::getInstance()->getUsernameById($articleEntity->getUserId()),
            'comments' => CommentRepository::getInstance()->getCommentsByArticleId($articleId)
        ];

        $pageTitle = 'Détails d\'un article';
        include_once './App/Templates/articles/show.php';
    }

    public function createSubmit()
    {
        $title = $_POST['title'];
        $tags = $_POST['tags'];
        $content = $_POST['content'];
        $date = date('Y-m-d H:i:s');
        $user_id = $_SESSION['user']->getId();

        $article = [
            'createdAt' => $date,
            'user_id' => $user_id
        ];

        $article = ArticleRepository::getInstance()->addArticle($article);

        $version = [
            'title' => $title,
            'isValid' => 0,
            'content' => $content,
            'updatedAt' => $date,
            'article_id' => $article->getId(),
            'user_id' => $user_id
        ];

        VersionRepository::getInstance()->addVersion($version);


        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            $tagName = trim($tag);
            $tag = tagRepository::getInstance()->getTagByName($tagName);
            if (!$tag) {
                $tag_id = TagRepository::getInstance()->addTag($tagName);
            } else {
                $tag_id = $tag->getId();
            }
            TagArticleRepository::getInstance()->addTagArticle($article->getId(), $tag_id);
        }


        header('Location: /');
    }

    public function editSubmit()
    {
        $title = $_POST['title'];
        $tags = $_POST['tags'];
        $content = $_POST['content'];
        $date = date('Y-m-d H:i:s');
        $user_id = $_SESSION['user']->getId();
        $article_id = $_POST['article_id'];

        $version = [
            'title' => $title,
            'isValid' => 0,
            'content' => $content,
            'updatedAt' => $date,
            'article_id' => $article_id,
            'user_id' => $user_id
        ];

        VersionRepository::getInstance()->addVersion($version);

        TagArticleRepository::getInstance()->deleteAllTagByArticleId($article_id);

        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            $tagName = trim($tag);
            $tag = tagRepository::getInstance()->getTagByName($tagName);
            if (!$tag) {
                $tag_id = TagRepository::getInstance()->addTag($tagName);
            } else {
                $tag_id = $tag->getId();
            }
            TagArticleRepository::getInstance()->addTagArticle($article_id, $tag_id);
        }

        header('Location: /');
    }

    public function create()
    {
        $editorType = 'create';
        $pageTitle = 'Création d\'un article';
        include_once './App/Templates/articles/editor.php';
    }

}

