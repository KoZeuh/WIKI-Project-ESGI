<?php

namespace App\Controller\Api;

use App\Model\Repository\TagRepository;

class CategoryApiController
{
    public function handleApiRequest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        switch ($requestMethod) {
            case 'GET':
                $this->getCategories();
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
}
