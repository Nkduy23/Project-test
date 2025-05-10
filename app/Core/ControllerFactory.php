<?php

namespace App\Core;

class ControllerFactory
{
    public static function create(string $controllerClass)
    {
        $container = new Container();
        return $container->get($controllerClass);
    }
}
