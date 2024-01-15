<?php

namespace App\Controller;

use DateTime;
use App\Model\Entity\Article;
use App\Model\Repository\ArticleOfTheDayRepository;
use App\Model\Repository\ArticleRepository;
use App\Model\Repository\UserRepository;

class HomeController
{
    public function index()
    {
        $articleOfTheDayRepository = new ArticleOfTheDayRepository();
        $articlesOfTheDay = $articleOfTheDayRepository->getArticlesOfTheDay();
    
        $formattedarticlesOfTheDay = [];
    
        foreach ($articlesOfTheDay as $article) {
            $dateTime = new DateTime($article['createdAt']);
            $newDateFormat = $dateTime->format('d/m/Y');
    
            $articleEntity = new Article($article['id'], $newDateFormat, $article['tags']);
            $version = $articleEntity->getLastVersion();
    
            $createdBy = $version->getUserId();
            $userName = null;
    
            if ($createdBy) {
                $userRepository = new UserRepository();
                $userName = $userRepository->getUsernameById($createdBy);
            }
    
            $formattedarticlesOfTheDay[] = [
                'article' => $articleEntity,
                'version' => $version,
                'createdByUsername' => $userName
            ];
        }

        $articleOfTheMonthRepository = new ArticleRepository();
        $articlesOfTheMonth = $articleOfTheMonthRepository->getArticlesOfTheMonth();

        foreach ($articlesOfTheMonth as $article) {
            $dateTime = new DateTime($article['createdAt']);
            $newDateFormat = $dateTime->format('d/m/Y');

            $articleEntity = new Article($article['id'], $newDateFormat, $article['tags']);
            $version = $articleEntity->getLastVersion();
            
            $createdBy = $version->getUserId();
            $userName = null;

            if ($createdBy) {
                $userRepository = new UserRepository();
                $userName = $userRepository->getUsernameById($createdBy);
            }

            $formattedArticlesOfTheMonth[] = [
                'article' => $articleEntity,
                'version' => $version,
                'createdByUsername' => $userName
            ];
        }

    
        $pageTitle = 'Accueil';
        include_once './App/Templates/home/index.php';
    }
    

}

