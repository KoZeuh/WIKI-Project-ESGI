<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
            include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
        });
    }
}

Autoloader::register();
