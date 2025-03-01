<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;

class UserController extends AdminController
{
    public function view()
    {
        $UserRepo = new UserRepository();
        $users = $UserRepo->getAll();

        require_once '../template/admin/user.phtml';
    }
    public function add()
    {
        
    }

    public function edit()
    {
    }

    public function delete()
    {
    }
}
