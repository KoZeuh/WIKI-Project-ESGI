<?php

namespace MyApp;

class FrontController
{
    public function run()
    {
        // Obtenez le chemin de la requête
        $uri = $_SERVER['REQUEST_URI'];

        // Exemple simple de routage basé sur l'URI
        if ($uri === '/user') {
            $controller = new Controller\UserController();
            $controller->index();
        } else {
            // Gérer les routes non trouvées
            echo '404 Not Found';
        }
    }
}
