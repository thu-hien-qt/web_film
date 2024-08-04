<?php

namespace Controller\Front;

use Controller\AbstractController;

class FilmController extends AbstractController
{
    public function view()
    {

        $GenreRepo = new \GenreRepository();
        $genres = $GenreRepo->getAll();

        $filmID = (isset($_GET["id"])) ? $_GET["id"] : null;

        // todo : show error when $filmID is missing

        if ($filmID) {
            $FilmRepo = new \FilmRepository();
            $film = $FilmRepo->getByFilmID($filmID);
            $filmRelatives = $FilmRepo->getByGenreOfFilm($film);
        } else {
            echo "Film ID is not set. Please provide a valid film ID.";
        }


        $url = $film->getLink();
        function getYouTubeID($url)
        {
            $urlComponents = parse_url($url);

            if (!isset($urlComponents['query'])) {
                return null;
            }

            parse_str($urlComponents['query'], $queryParams);

            if (isset($queryParams['v'])) {
                return $queryParams['v'];
            }

            return null;
        }

        $videoID = getYouTubeID($url);

        require_once "template/public/view.phtml";
    }

    public function category()
    {
        $GenreRepo = new \GenreRepository();
        $genres = $GenreRepo->getAll();

        if (isset($_GET['id'])) {
            $genreID = $_GET['id'];
            $FilmRepo = new \FilmRepository();
            $films = $FilmRepo->getByGenreID($genreID);
        }

        require_once 'template\public\category.phtml';
    }
}
