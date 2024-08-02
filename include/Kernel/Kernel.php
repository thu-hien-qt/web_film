<?php

namespace Kernel;


class Kernel
{
    function run() {
        $controller = $_GET["controller"] ?? "";
        $action = $_GET["action"] ?? "";

        $callback = $this->routing($controller, $action);
        $class = $callback["class"];
        $method = $callback["method"];

        $controllerInstance = new $class();
        $controllerInstance->{$method}();
    }

    private function routing($controller, $action) {
        $mapping = [
            "front.film" => [
                "view" => [
                    "class" => "Controller\Front\FilmController",
                    "method" => "view"
                ]
            ]
        ];

        // todo : error when $controller or $action is empty

        if (empty($mapping[$controller][$action])) {
            throw new \Exception("Route not found : controller $controller, action $action");
        }

        return $mapping[$controller][$action];
    }
}