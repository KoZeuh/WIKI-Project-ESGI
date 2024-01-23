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
            return header('Location: /article/show/' . $commentaireEntity->getArticleId());
        }

        if (!isset($_SESSION['user'])) {
            return header('Location: /login');
        }

        if ($_SESSION['user']->getRole() !== 'ROLE_ADMIN') {
            if ($_SESSION['user']->getId() !== $commentaireEntity->getUserId()) {
                return header('Location: /article/show/' . $commentaireEntity->getArticleId());
            }
        }

        CommentRepository::getInstance()->deleteComment($commentaireId);

        header('Location: /article/show/' . $commentaireEntity->getArticleId());
    }

    public function addComment($articleId)
    {
        $userId = $_SESSION['user']->getId();
        $content = $_POST['addComment'];

        CommentRepository::getInstance()->addComment($content, $userId, $articleId);

        header('Location: /article/show/' . $articleId);
    }
}

