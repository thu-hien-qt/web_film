<?php

namespace Controller\Admin;

class LoginController extends AdminController
{
    public function checkPermission()
    {
        return true;
    }

    public function login() {
        $GenreRepo = new \GenreRepository();
        $genres = $GenreRepo->getAll();

        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $userName = $_POST["username"];
            $password = $_POST["password"];
            $userRepo = new \UserRepository();
            $user = $userRepo->getUser($userName, $password);

            if (empty($user)) {
                $error = "In correct password";
            } else {
                $_SESSION["name"] = $user->getName();
                header("location:admin/index.php?controller=admin.home&action=index");
            }
        }

        require_once 'template\admin\login.phtml';
    }
}