<?php

namespace App;

use App\Model\Repository\UserRepository;

class FrontController
{
    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        session_start();

        if (strpos($uri, "/api/") === 0) {
            $this->handleApiRequest($uri);
            return;
        }

        switch ($uri) {
            case '/':
                $controller = new Controller\HomeController();
                $controller->index();
                break;
            case "/index":
                $controller = new Controller\HomeController();
                $controller->index();
                break;
            case '/register':
                $controller = new Controller\AuthController();
                $controller->register();
                break;
            case '/login':
                $controller = new Controller\AuthController();
                $controller->login();
                break;
            case '/logout':
                $controller = new Controller\AuthController();
                $controller->logout();
                break;
            case '/article/list':
                $controller = new Controller\ArticleController();
                $controller->list();
                break;
            case '/compte':
                $controller = new Controller\AccountController();
                $controller->index();
                break;
//          Switch pour l'admin
//          Affichage des différentes catégories
            case '/admin':
                $controller = new Controller\Admin\AdminController();
                $controller->index();
                break;
            case '/admin/articles':
                $controller = new Controller\Admin\AdminController();
                $controller->articles();
                break;
            case '/admin/user':
                $controller = new Controller\Admin\AdminController();
                $controller->users();
                break;
            case '/admin/tags':
                $controller = new Controller\Admin\AdminController();
                $controller->tags();
                break;
            case '/admin/comments':
                $controller = new Controller\Admin\AdminController();
                $controller->comments();
                break;
//          Gestion des articles
            case '/article/create':
                $controller = new Controller\Admin\ArticleController();
                $controller->create();
                break;
            case '/article/create/submit':
                $controller = new Controller\Admin\ArticleController();
                $controller->createSubmit();
                break;
            default:
                // Ce code permet de gérer les redirections quand l'URL contient des paramètres (ex: /article/show/1, /user/show/1, /article/edit/1, /article/delete/1, etc.)
                // L'URL est découpée en segments, et le nom du contrôleur et de la méthode sont modifiés en fonction de l'action
                // Exemple : /article/show/1 devient ArticleController->show(1)
                // Exemple : /article/edit/1 devient Admin\ArticleController->edit(1)
                $segments = explode('/', $uri);
                if (count($segments) >= 3) {
                    $controllerName = ucfirst($segments[1]) . 'Controller';
                    $methodName = $segments[2];

                    // Vérifiez si l'action est "edit" ou "remove"
                    $isEditAction = in_array('edit', $segments);
                    $isRemoveAction = in_array('delete', $segments);

                    // Modifiez le nom du contrôleur en fonction de l'action
                    if ($isEditAction || $isRemoveAction) {
                        $controllerName = 'Admin\\' . $controllerName;
                    }

                    $controllerClass = "App\\Controller\\$controllerName";

                    if (class_exists($controllerClass) && method_exists($controllerClass, $methodName)) {
                        $controller = new $controllerClass();

                        return call_user_func_array([$controller, $methodName], array_slice($segments, 3));
                    }
                }
                echo '404 Not Found';
        }
    }

    private function handleApiRequest($uri)
    {
        // Supprimez le préfixe "/api" de l'URI
        $apiRoute = substr($uri, 4);

        $apiKeyProvided = isset($_SERVER['HTTP_APIKEY']) ? $_SERVER['HTTP_APIKEY'] : null;

        if (!UserRepository::getInstance()->isValidApiKey($apiKeyProvided)) {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['error' => 'Invalid API key']);
            return;
        }

        

        switch ($apiRoute) {
            case '/articles':
                $controller = new Controller\Api\ArticleApiController();
                $controller->handleApiRequest();
                break;

            default:
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['error' => 'Route' .  $apiRoute . ' Not Found']);
                break;
        }
    }

}

