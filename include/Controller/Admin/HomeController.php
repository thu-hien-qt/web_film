<?php

namespace Controller\Admin;

class HomeController extends AdminController
{
    public function index()
    {
        $GenreRepo = new \GenreRepository();
        $genres = $GenreRepo->getAll();

        $FilmRepo = new \FilmRepository();
        $films = $FilmRepo->getAll();

        require_once "../template/admin/index.phtml";
    }

}