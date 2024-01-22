<?php

namespace App\Controller\Admin;

use App\Model\Repository\UserRepository;

class UserController
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

        echo print_r($_POST, true);

        $username = $_POST['username'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];

        $user = [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'role' => $role
        ];

        $user = UserRepository::getInstance()->editUser($user);
        if ($user) {
            header('Location: /admin/users');
        } else {
            echo 'Erreur lors de la modification de l\'utilisateur';
            echo '<a href="/admin/user">Retour</a>';
        }
    }

    public function delete($id)
    {
        $user = UserRepository::getInstance()->deleteUser($id);
        if ($user) {
            header('Location: /admin/users');
        } else {
            echo 'Erreur lors de la suppression de l\'utilisateur';
            echo '<a href="/admin/user">Retour</a>';
        }
    }

    public function resetApiKey($id)
    {
        $userOBJ = UserRepository::getInstance()->getUserById($id);
        $user = UserRepository::getInstance()->regenerateApiKey($userOBJ);
        if ($user) {
            header('Location: /admin/users');
        } else {
            echo 'Erreur lors de la réinitialisation de la clé API';
            echo '<a href="/admin/user">Retour</a>';
        }
    }
}
