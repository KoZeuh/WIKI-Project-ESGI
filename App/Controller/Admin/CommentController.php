<?php

namespace App\Controller\Admin;

use App\Model\Repository\CommentRepository;

class CommentController
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
        CommentRepository::getInstance()->deleteComment($id);
        header('Location: /admin/comments');
    }
}