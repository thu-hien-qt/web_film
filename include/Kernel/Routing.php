<?php

namespace Kernel;

class Router
{
    public function routing($controller, $action)
    {
        $mapping = [
            "front.home" => [
                "index" => [
                    "class" => \Controller\Front\HomeController::class,
                    "method" => "index"
                ]
            ],
            "front.film" => [
                "view" => [
                    "class" => \Controller\Front\FilmController::class,
                    "method" => "view"
                ]
            ],

            "admin.home" => [
                "index" => [
                    "class" => \Controller\Admin\HomeController::class,
                    "method" => "index"
                ],
            ],
            "admin.login" => [
                "login" => [
                    "class" => \Controller\Admin\LoginController::class,
                    "method" => "login"
                ]
            ]
        ];

        // todo : error when $controller or $action is empty

        if (empty($mapping[$controller][$action])) {
            throw new \Exception("Route not found : controller $controller, action $action");
        }

        return $mapping[$controller][$action];
    }

    public function redirect($controller, $action)
    {
        header("location:index.php?controller=$controller&action=$action");
    }
}