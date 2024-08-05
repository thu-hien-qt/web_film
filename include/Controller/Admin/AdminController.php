<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Kernel\Router;

abstract class AdminController extends AbstractController
{
    public function checkPermission() {
        if(!isset($_SESSION["name"])) {
            $router = new Router();
            $router->redirect("admin.login", "login");
        }
    }
}