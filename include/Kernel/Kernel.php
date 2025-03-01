<?php

namespace App\Kernel;

class Kernel
{
    function run($interface) {
        $controller = $_GET["controller"] ?? "";
        $action = $_GET["action"] ?? "";

        if (empty($controller) && empty($action)) {
            if ($interface == 'front') {
                $controller = "front.home";
            } elseif ($interface == 'admin') {
                $controller = "admin.home";
            }
            $action = "index";
        }

        $router = new Router();
        $callback = $router->routing($controller, $action);
        $class = $callback["class"];
        $method = $callback["method"];

        $controllerInstance = new $class();
        $controllerInstance->checkPermission();

        $controllerInstance->{$method}();
    }

}
