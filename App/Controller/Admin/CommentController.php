<?php

namespace App\Controller\Admin;

use App\Model\Repository\CommentRepository;

class CommentController
{
    public function delete($id)
    {
        CommentRepository::getInstance()->deleteComment($id);
        header('Location: /admin/comments');
    }
}