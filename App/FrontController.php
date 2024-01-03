<?php

namespace App;

class FrontController
{
    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        switch ($uri) {
            case '/':
                $controller = new Controller\HomeController();
                $controller->index();
                break;
            case '/user':
                $controller = new Controller\UserController();
                $controller->index();
                break;
            case '/article':
                $controller = new Controller\ArticleController();
                $controller->index();
                break;
            case '/admin':
                $controller = new Controller\AdminController();
                $controller->index();
                break;
            case '/admin/articles':
                $controller = new Controller\AdminController();
                $controller->articles();
                break;
            case '/article/create':
                $controller = new Controller\ArticleController();
                $controller->create();
                break;
            case '/article/create/submit':
                $controller = new Controller\ArticleController();
                $controller->createSubmit();
                break;
            default:
                echo '404 Not Found';
        }
    }
}
