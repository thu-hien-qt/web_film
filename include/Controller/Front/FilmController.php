<?php

namespace Controller\Front;

class FilmController
{
    public function view() {

        $GenreRepo = new \GenreRepository();
        $genres = $GenreRepo->getAll();

        $filmID = (isset($_GET["id"])) ? $_GET["id"] : null;

        // todo : show error when $filmID is missing

        if ($filmID) {
            $FilmRepo = new \FilmRepository();
            $film = $FilmRepo->getByFilmID($filmID);
            $filmRelatives = $FilmRepo->getByGenreOfFilm($film);
        }


        $url = $film->getLink();
        function getYouTubeID($url) {
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
}