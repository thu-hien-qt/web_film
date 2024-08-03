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
                ],
                "category" => [
                    "class" => \Controller\Front\FilmController::class,
                    "method" => "category"
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
            ],
            "admin.film" => [
                "edit" => [
                    "class" => \Controller\Admin\FilmController::class,
                    "method" => "edit"
                ],
                "delete" => [
                    "class" => \Controller\Admin\FilmController::class,
                    "method" => "delete"
                ],
                "add" => [
                    "class" => \Controller\Admin\FilmController::class,
                    "method" => "add"
                ]
            ],
            "admin.person" => [
                "view" => [
                    "class" => \Controller\Admin\PersonController::class,
                    "method" => "view"
                ],
                "edit" => [
                    "class" => \Controller\Admin\PersonController::class,
                    "method" => "edit"
                ],
                "add" => [
                    "class" => \Controller\Admin\PersonController::class,
                    "method" => "add"
                ],
                "delete" => [
                    "class" => \Controller\Admin\PersonController::class,
                    "method" => "delete"
                ]
            ],
            "admin.genre" => [
                "view" => [
                    "class" => \Controller\Admin\GenreController::class,
                    "method" => "view"
                ],
                "edit" => [
                    "class" => \Controller\Admin\GenreController::class,
                    "method" => "edit"
                ],
                "add" => [
                    "class" => \Controller\Admin\GenreController::class,
                    "method" => "add"
                ],
                "delete" => [
                    "class" => \Controller\Admin\GenreController::class,
                    "method" => "delete"
                ]
            ],
            "admin.user" => [
                "view" => [
                    "class" => \Controller\Admin\UserController::class,
                    "method" => "view"
                ],
                "edit" => [
                    "class" => \Controller\Admin\UserController::class,
                    "method" => "edit"
                ],
                "add" => [
                    "class" => \Controller\Admin\UserController::class,
                    "method" => "add"
                ],
                "delete" => [
                    "class" => \Controller\Admin\UserController::class,
                    "method" => "delete"
                ]
            ],
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
