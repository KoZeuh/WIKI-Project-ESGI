<?php

namespace App\Controller\Api;

use App\Model\Repository\TagRepository;
use App\Model\Repository\TagArticleRepository;
use App\Model\Repository\VersionRepository;

class CategoryApiController
{
    public function handleApiRequest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $uriSegments = explode('/', $_SERVER['REQUEST_URI']);

        $categoryId = isset($uriSegments[3]) && is_numeric($uriSegments[3]) ? (int)$uriSegments[3] : null;

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
        $versions = TagArticleRepository::getInstance()->getVersionArticleByTagIg($categoryId);

        if (!$versions) {
            header('Content-Type: application/json');
            header('HTTP/1.1 404 Not Found');
            echo json_encode(['error' => 'No Category Found for id ' . $categoryId ]);
        } else {
            $versionsFormatted = [];
            foreach ($versions as $version) {
                $versionsFormatted[] = [
                    'id' =>  $version->getId(),
                    'title' => $version->getTitle(),
                    'isValid' => $version->getIsValid(),
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
