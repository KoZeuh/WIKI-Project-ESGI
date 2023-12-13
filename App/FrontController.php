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
            default:
                echo '404 Not Found';
        }
    }
}
