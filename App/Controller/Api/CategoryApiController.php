<?php

namespace App\Controller\Api;

use App\Model\Repository\TagRepository;
use App\Model\Repository\TagArticleRepository;

class CategoryApiController
{
    public function handleApiRequest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $uriSegments = explode('/', $_SERVER['REQUEST_URI']);

        $categoryId = isset($uriSegments[3]) && is_numeric($uriSegments[3]) ? (int)$uriSegments[3] : null;
        var_dump ($categoryId);

        switch ($requestMethod) {
            case 'GET':
                if ($categoryId !== null) {
                    $this->getCategoryArticles($categoryId);
                } else {
                    $this->getCategories();
                }
                break;
            default:
                echo '405 Method Not Allowed';
        }
    }

    private function getCategories()
    {
        $categories = TagRepository::getInstance()->getTags();
        $categoriesFormatted = [];
        foreach ($categories as $category) {
            $categoriesFormatted[] = [
                'id' =>  $category->getId(),
                'name' => $category->getName()
            ];
        }
        header('Content-Type: application/json');

        echo json_encode($categoriesFormatted);
    }

    private function getCategoryArticles($categoryId)
    {
        $articles = TagArticleRepository::getInstance()->getArticlesByTagId($categoryId);

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

        echo json_encode($tagFormatted);
    }
}
