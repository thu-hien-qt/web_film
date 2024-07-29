<?php
require_once "include/inc.php";
session_start();
$GenreRepo = new GenreRepository;
$genres = $GenreRepo->getAll();

$filmID = (isset($_GET["id"])) ? $_GET["id"] : null;

if ($filmID) {
    $FilmRepo = new FilmRepository;
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

require_once "template/public/view.phtml"
?>