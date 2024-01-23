<?php

namespace App\Controller\Admin;

use App\Model\Repository\ArticleRepository;
use App\Model\Repository\TagArticleRepository;
use App\Model\Repository\VersionRepository;

class ArticleController
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'ROLE_ADMIN') {
            header('Location: /login');
            exit();
        }
    }

    public function delete($id)
    {
        ArticleRepository::getInstance()->deleteArticle($id);
        header('Location: /admin/articles');
    }

    public function edit($id)
    {
        $pageTitle = 'Modifier un article';
        $editorType = 'edit';

        $article = ArticleRepository::getInstance()->getArticleById($id);
        $tags = TagArticleRepository::getInstance()->getTagsByArticleId($id);
        $tagInString = [];
        foreach ($tags as $tag) {
            $tagInString[] = $tag->getName();
        }
        $tagInString = implode(', ', $tagInString);
        $lastVersion = VersionRepository::getInstance()->getLastVersionByArticleId($id);
        include_once './App/Templates/articles/editor.php';
    }
}
