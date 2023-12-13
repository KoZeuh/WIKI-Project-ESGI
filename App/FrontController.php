<?php

namespace App;

class FrontController
{
    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if ($uri === '/'){
            $controller = new Controller\HomeController();
            $controller->index();
        } elseif ($uri === '/user') {
            $controller = new Controller\UserController();
            $controller->index();
        } elseif ($uri === '/article') {
            $controller = new Controller\ArticleController();
            $controller->index();
        } else {
            echo '404 Not Found';
        }
    }
}
