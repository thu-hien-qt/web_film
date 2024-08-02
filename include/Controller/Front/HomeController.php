<?php

namespace Controller\Front;

use Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        unset($_SESSION["name"]);
        $GenreRepo = new \GenreRepository();
        $genres = $GenreRepo->getAll();

        $FilmRepo = new \FilmRepository();
        $films = $FilmRepo->getAll();

        require_once "template/public/index.phtml";
    }
}