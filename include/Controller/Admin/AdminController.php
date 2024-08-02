<?php

namespace Controller\Admin;

use Controller\AbstractController;
use Kernel\Router;

class AdminController extends AbstractController
{
    public function checkPermission() {
        if(!isset($_SESSION["name"])) {
            $router = new Router();
            $router->redirect("admin.login", "login");
        }
    }
}