<?php

namespace App\Controller;

use App\Model\Repository\ArticleRepository;
use App\Model\Repository\UserRepository;
use App\Model\Repository\CommentRepository;

class CommentaireController
{
    public function remove($commentaireId)
    {
        $commentaireEntity = CommentRepository::getInstance()->getComment($commentaireId);

        if (!$commentaireEntity) {
            return header('Location: /article/show/' . $commentaireEntity->getArticle_id());
        }

        if (!isset($_SESSION['user'])) {
            return header('Location: /login');
        }

        if ($_SESSION['user']->getRole() !== 'ROLE_ADMIN') {
            if ($_SESSION['user']->getId() !== $commentaireEntity->getUser_id()) {
                return header('Location: /article/show/' . $commentaireEntity->getArticle_id());
            }
        }

        CommentRepository::getInstance()->deleteComment($commentaireId);

        header('Location: /article/show/' . $commentaireEntity->getArticle_id());
    }
}

