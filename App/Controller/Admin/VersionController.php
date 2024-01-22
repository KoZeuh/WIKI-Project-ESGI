<?php

namespace App\Controller\Admin;

use App\Model\Repository\ArticleRepository;
use App\Model\Repository\VersionRepository;

class VersionController
{
    public function delete($id)
    {
        $nbVersionForArticle = VersionRepository::getInstance()->getCountVersionsByArticleId($id);
        if ($nbVersionForArticle > 1) {
            VersionRepository::getInstance()->deleteVersion($id);
        } else {
            $articleId = VersionRepository::getInstance()->getArticleIdByVersionId($id);
            VersionRepository::getInstance()->deleteVersion($id);
            ArticleRepository::getInstance()->deleteArticle($articleId);
        }
        header('Location: /admin/articles');
    }

    public function validate($id)
    {
        VersionRepository::getInstance()->validateVersion($id);
        header('Location: /admin/articles');
    }

    public function unvalidate($id)
    {
        VersionRepository::getInstance()->unvalidateVersion($id);
        header('Location: /admin/articles');
    }
}