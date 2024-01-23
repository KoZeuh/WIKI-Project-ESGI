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
    
    public function changePassword()
    {
        $result = UserRepository::getInstance()->changePassword($_SESSION['user']);
        if ($result) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Mot de passe modifié avec succès']);
        } else {
            header('Content-Type: application/json');
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['error' => 'An error occurs during your password modification ']);
        }
    }
}

