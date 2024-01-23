<?php

namespace App\Controller;

use DateTime;
use App\Model\Entity\Article;

use App\Model\Repository\ArticleOfTheDayRepository;
use App\Model\Repository\ArticleRepository;
use App\Model\Repository\UserRepository;
use App\Model\Repository\VersionRepository;
use App\Model\Repository\TagArticleRepository;

class HomeController
{
    public function index()
    {
        $articleOfTheDayRepository = ArticleOfTheDayRepository::getInstance();
        $articleOfTheMonthRepository = ArticleRepository::getInstance();
        $userRepository = UserRepository::getInstance();


        $articlesOfTheDay = $articleOfTheDayRepository->getArticlesOfTheDay();
        $articlesOfTheMonth = $articleOfTheMonthRepository->getArticlesOfTheMonth();

        $formattedArticlesOfTheDay = [];
        $formattedArticlesOfTheMonth = [];
    
        foreach ($articlesOfTheDay as $articleEntity) {
            $articleId = $articleEntity->getId();

            $articleLastValidVersionEntity = VersionRepository::getInstance()->getLastVersionByArticleId($articleId);
            $tagsEntity = TagArticleRepository::getInstance()->getTagsByArticleId($articleId);

            $createdAt = new DateTime($articleEntity->getCreatedAt());
            $createdBy = $articleLastValidVersionEntity->getUserId();
            $createdByUserName = null;
    
            if ($createdBy) {
                $createdByUserName = $userRepository->getUsernameById($createdBy);
            }
    
            $formattedArticlesOfTheDay[] = [
                'article' => $articleEntity,
                'version' => $articleLastValidVersionEntity,
                'tags' => $tagsEntity,
                'createdByUsername' => $createdByUserName,
                'createdAt' => $createdAt->format('d/m/Y')
            ];
        }

        
        foreach ($articlesOfTheMonth as $articleEntity) {
            $articleId = $articleEntity->getId();

            $articleLastValidVersionEntity = VersionRepository::getInstance()->getLastVersionByArticleId($articleId);

            if (!$articleLastValidVersionEntity || !$articleLastValidVersionEntity->getIsValid()) {
                continue;
            }
            
            $tagsEntity = TagArticleRepository::getInstance()->getTagsByArticleId($articleId);

            $createdAt = new DateTime($articleEntity->getCreatedAt());
            $createdBy = $articleLastValidVersionEntity->getUserId();
            $createdByUserName = null;
    
            if ($createdBy) {
                $createdByUserName = $userRepository->getUsernameById($createdBy);
            }
    
            $formattedArticlesOfTheMonth[] = [
                'article' => $articleEntity,
                'version' => $articleLastValidVersionEntity,
                'tags' => $tagsEntity,
                'createdByUsername' => $createdByUserName,
                'createdAt' => $createdAt->format('d/m/Y')
            ];
        }

    
        $pageTitle = 'Accueil';
        include_once './App/Templates/home/index.php';
    }
    

}

