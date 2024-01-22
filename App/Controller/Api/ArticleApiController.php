<?php

namespace App\Controller\Api;

use App\Model\Repository\ArticleRepository;
use App\Model\Repository\VersionRepository;
use App\Model\Repository\UserRepository;

class ArticleApiController
{
    public function handleApiRequest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        switch ($requestMethod) {
            case 'GET':
                $this->getArticles();
                break;
            case 'POST':
                $this->createArticle();
                break;
            case 'PUT':
                $this->updateArticle();
                break;
            case 'DELETE':
                $this->deleteArticle();
                break;
            default:
                echo '405 Method Not Allowed';
        }
    }

    private function getArticles()
    {
        $articles = ArticleRepository::getInstance()->getArticles();
        $lastVersionArticles = [];
        foreach ($articles as $article) {
            $lastVersion = VersionRepository::getInstance()->getLastVersionByArticleId($article->getId());
            $user = UserRepository::getInstance()->getUsernameById($article->getUserId());
            $lastVersionArticles[] = [
                'title' =>  $lastVersion->getTitle(),
                'content' => $lastVersion->getContent(),
                'author' => $user
            ];
        }
        header('Content-Type: application/json');

        echo json_encode($lastVersionArticles);
    }
}
