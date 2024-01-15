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
    
                $userModel = new UserRepository();

                if ($userModel->getUserByUsername($username)) {
                    $errorsAlert[] = 'Ce nom d\'utilisateur est déjà utilisé !';
                } else {
                    $success = $userModel->registerUser($email, $username, $firstname, $lastname, $password);
        
                    if ($success) {
                        $_SESSION['user'] = new User($success['id'], $success['email'], $success['username'], $success['firstname'], $success['lastname'], $success['password']);
                        
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

            $userModel = new UserRepository();
            $user = $userModel->getUserByUsernameAndPassword($username, $password);

            if ($user) {
                $_SESSION['user'] = new User($user['id'], $user['email'], $user['username'], $user['firstname'], $user['lastname'], $user['password'], $user['role']);

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

