<?php

namespace App;

class FrontController
{
    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        session_start();

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
            case '/user':
                $controller = new Controller\Admin\UserController();
                $controller->index();
                break;
            case '/article/list':
                $controller = new Controller\ArticleController();
                $controller->list();
                break;
            case '/article/create':
                $controller = new Controller\Admin\ArticleController();
                $controller->create();
                break;
            case '/article/create/submit':
                $controller = new Controller\Admin\ArticleController();
                $controller->createSubmit();
                break;
            case '/admin':
                $controller = new Controller\Admin\AdminController();
                $controller->index();
                break;
            case '/admin/articles':
                $controller = new Controller\Admin\AdminController();
                $controller->articles();
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
}
