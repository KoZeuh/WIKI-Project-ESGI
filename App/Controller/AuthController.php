<?php

namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Repository\UserRepository;

class AuthController
{
    public function register()
    {
        $errorsAlert = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['form_register_email'], $_POST['form_register_username'], $_POST['form_register_firstname'], $_POST['form_register_lastname'], $_POST['form_register_password'])) {
                $email = filter_var($_POST['form_register_email'], FILTER_VALIDATE_EMAIL);
                $username = htmlspecialchars($_POST['form_register_username']);
                $firstname = htmlspecialchars($_POST['form_register_firstname']);
                $lastname = htmlspecialchars($_POST['form_register_lastname']);
                $password = $_POST['form_register_password'];
                $apiKey = uniqid('', true);
    
                $userModel = UserRepository::getInstance();
                $userEntity = $userModel->getUserByUsername($username);

                if ($userEntity) {
                    $errorsAlert[] = 'Ce nom d\'utilisateur est déjà utilisé !';
                } else {
                    $userEntity = $userModel->registerUser($email, $username, $firstname, $lastname, $password, $apiKey);
        
                    if ($userEntity) {
                        $_SESSION['user'] = $userEntity;
                        
                        header('Location: /');
                        exit();
                    } else {
                        $errorsAlert[] = 'Une erreur est survenue';
                    }
                }
            } else {
                $errorsAlert[] = 'Veuillez remplir tous les champs';
            }
        }    

        $pageTitle = 'Inscription';
        include_once './App/Templates/auth/register.php';
    }

    public function login()
    {
        $errorsAlert = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['form_login_username']);
            $password = $_POST['form_login_password'];

            $userModel = UserRepository::getInstance();
            $userEntity = $userModel->getUserByUsernameAndPassword($username, $password);

            if ($userEntity) {
                $_SESSION['user'] = $userEntity;

                header('Location: /');
                exit();
            } else {
                $errorsAlert[] = 'Username or password incorrect';
            }
        }

        $pageTitle = 'Connexion';
        include_once './App/Templates/auth/login.php';
    }
    
    function logout()
    {
        session_destroy();
        header('Location: /');
        exit();
    }

}

