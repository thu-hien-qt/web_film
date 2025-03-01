<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Model\User;
use App\Repository\UserRepository;

class SignUpController extends AbstractController
{
    public function signUp()
    {
        if (isset($_POST["submit"])) {
            if (isset($_POST["name"]) && isset($_POST["userName"]) && isset($_POST["password"])) {
                $user = new User;
                $user->setName($_POST["name"]);
                $user->setUserName($_POST["userName"]);
                $user->setPassword($_POST["password"]);
                $UserRepo = new UserRepository;
                $UserRepo->insert($user);
                $_SESSION["name"] = $user->getName();
                header("location:admin/index.php?controller=admin.home&action=index");
            } else {
                echo "<p>Please complete all information";
            }
        } 
        require_once "template/public/sign_up.phtml";
    }
}
