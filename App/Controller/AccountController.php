<?php

namespace App\Controller;
use App\Model\Repository\UserRepository;

class AccountController
{
    public function index()
    {
        $user = $_SESSION['user'];

        $pageTitle = 'Accueil';
        include_once './App/Templates/account/index.php';
    }
    

    public function regenerateApiKey()
    {
        $newApiKey = UserRepository::getInstance()->regenerateApiKey($_SESSION['user']);

        if ($newApiKey) {
            $_SESSION['user']->setApiKey($newApiKey);
        }

        return header('Location: /compte');
    }
}

