<?php

namespace App\Controller\Admin;

use App\Model\Repository\ArticleRepository;

class ArticleController
{
    public function delete($id)
    {
        ArticleRepository::getInstance()->deleteArticle($id);
        header('Location: /admin/articles');
    }
}
