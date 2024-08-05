<?php

namespace App\Kernel;

class Router
{
    public function routing($controller, $action)
    {
        $mapping = [
            "front.home" => [
                "index" => [
                    "class" => \App\Controller\Front\HomeController::class,
                    "method" => "index"
                ]
            ],
            "front.film" => [
                "view" => [
                    "class" => \App\Controller\Front\FilmController::class,
                    "method" => "view"
                ],
                "listByCategory" => [
                    "class" => \App\Controller\Front\FilmController::class,
                    "method" => "category"
                ]
            ],
            "front.comment" => [
                "get" => [
                    "class" => \App\Controller\Front\CommentController::class,
                    "method" => "getComment"
                ],
                "post" => [
                    "class" => \App\Controller\Front\CommentController::class,
                    "method" => "postComment"
                ]
                ],

            "admin.home" => [
                "index" => [
                    "class" => \App\Controller\Admin\HomeController::class,
                    "method" => "index"
                ],
            ],
            "admin.login" => [
                "login" => [
                    "class" => \App\Controller\Admin\LoginController::class,
                    "method" => "login"
                ]
            ],
            "admin.film" => [
                "edit" => [
                    "class" => \App\Controller\Admin\FilmController::class,
                    "method" => "edit"
                ],
                "delete" => [
                    "class" => \App\Controller\Admin\FilmController::class,
                    "method" => "delete"
                ],
                "add" => [
                    "class" => \App\Controller\Admin\FilmController::class,
                    "method" => "add"
                ]
            ],
            "admin.person" => [
                "view" => [
                    "class" => \App\Controller\Admin\PersonController::class,
                    "method" => "view"
                ],
                "edit" => [
                    "class" => \App\Controller\Admin\PersonController::class,
                    "method" => "edit"
                ],
                "add" => [
                    "class" => \App\Controller\Admin\PersonController::class,
                    "method" => "add"
                ],
                "delete" => [
                    "class" => \App\Controller\Admin\PersonController::class,
                    "method" => "delete"
                ]
            ],
            "admin.genre" => [
                "view" => [
                    "class" => \App\Controller\Admin\GenreController::class,
                    "method" => "view"
                ],
                "edit" => [
                    "class" => \App\Controller\Admin\GenreController::class,
                    "method" => "edit"
                ],
                "add" => [
                    "class" => \App\Controller\Admin\GenreController::class,
                    "method" => "add"
                ],
                "delete" => [
                    "class" => \App\Controller\Admin\GenreController::class,
                    "method" => "delete"
                ]
            ],
            "admin.user" => [
                "view" => [
                    "class" => \App\Controller\Admin\UserController::class,
                    "method" => "view"
                ],
                "edit" => [
                    "class" => \App\Controller\Admin\UserController::class,
                    "method" => "edit"
                ],
                "add" => [
                    "class" => \App\Controller\Admin\UserController::class,
                    "method" => "add"
                ],
                "delete" => [
                    "class" => \App\Controller\Admin\UserController::class,
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
