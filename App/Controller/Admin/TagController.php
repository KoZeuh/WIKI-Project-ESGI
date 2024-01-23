<?php

namespace App\Controller\Admin;

use App\Model\Repository\TagRepository;

class TagController
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'ROLE_ADMIN') {
            header('Location: /login');
            exit();
        }
    }

    public function edit($id)
    {
        $name = $_POST['name'];

        $tag = [
            'id' => $id,
            'name' => $name,
        ];

        $tag = TagRepository::getInstance()->editTag($tag);
        if ($tag) {
            header('Location: /admin/tags');
        } else {
            echo 'Erreur lors de la modification du tag';
            echo '<a href="/admin/tags">Retour</a>';
        }
    }

    public function delete($id)
    {
        $tag = TagRepository::getInstance()->deleteTag($id);
        if ($tag) {
            header('Location: /admin/tags');
        } else {
            echo 'Erreur lors de la suppression du tag';
            echo '<a href="/admin/tags">Retour</a>';
        }
    }
}