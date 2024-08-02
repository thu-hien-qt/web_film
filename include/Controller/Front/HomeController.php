<?php

namespace Controller\Front;

class HomeController
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