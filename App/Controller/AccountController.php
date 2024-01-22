<?php

namespace App\Controller;

use DateTime;
use App\Model\Entity\Article;

use App\Model\Repository\ArticleOfTheDayRepository;
use App\Model\Repository\ArticleRepository;
use App\Model\Repository\UserRepository;
use App\Model\Repository\VersionRepository;
use App\Model\Repository\TagArticleRepository;

class AccountController
{
    public function index()
    {
        $userRepository = UserRepository::getInstance();

        $user = $_SESSION['user'];

        $apiKey = $user->getApiKey();

        $pageTitle = 'Accueil';
        include_once './App/Templates/account/index.php';
    }
    

}

