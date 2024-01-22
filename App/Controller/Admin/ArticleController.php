<?php

namespace App\Controller\Admin;

use App\Model\Repository\ArticleRepository;
use App\Model\Repository\VersionRepository;

class ArticleController
{
    public function createSubmit()
    {
        $title = $_POST['title'];
        $tags = $_POST['tags'];
        $content = $_POST['content'];
        $date = date('Y-m-d H:i:s');
//        $user_id = $_SESSION['user']['id'];
        $user_id = 1;

        $article = [
            'createdAt' => $date,
            'tags' => $tags,
            'user_id' => $user_id
        ];

        $article_id = ArticleRepository::getInstance()->addArticle($article);

        $version = [
            'title' => $title,
            'isValid' => 0,
            'content' => $content,
            'updatedAt' => $date,
            'article_id' => $article_id,
            'user_id' => $user_id
        ];

        VersionRepository::getInstance()->addVersion($version);


        header('Location: /');
    }

    public function create()
    {
        $editorType = 'create';
        $pageTitle = 'Création d\'un article';
        include_once './App/Templates/articles/editor.php';
    }

    public function delete($id)
    {
        VersionRepository::getInstance()->deleteVersion($id);
        header('Location: /admin/articles');
    }
}
