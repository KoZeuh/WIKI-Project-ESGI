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
        $uriSegments = explode('/', $_SERVER['REQUEST_URI']);

        $versionId = isset($uriSegments[3]) && is_numeric($uriSegments[3]) ? (int)$uriSegments[3] : null;

        switch ($requestMethod) {
            case 'GET':
                if ($versionId !== null) {
                    $this->getArticleVersions($versionId);
                } else {
                    $this->getArticles();
                }
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

    private function getArticleVersions($id)
    {
        $versions = VersionRepository::getInstance()->getVersionsByArticleId($id);

        if (!$versions) {
            header('Content-Type: application/json');
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'No article found for id ' . $id ]);
            
        } else {
            $versionsFormatted = [];
            foreach ($versions as $version) {
                $versionsFormatted[] = [
                    'id' =>  $version->getId(),
                    'title' => $version->getTitle(),
                    'content' => $version->getContent(),
                    'updatedAt' => $version->getUpdatedAt(),
                    'article_id' => $version->getArticleId(),
                    'user_id' => $version->getUserId()
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($versionsFormatted);
        }

    }
}
