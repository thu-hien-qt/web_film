<?php

require_once "../include/inc.php";
session_start();
$GenreRepo = new GenreRepository;
$genres = $GenreRepo->getAll();

$getFilm = new FilmRespository;
$films = $getFilm->getAll();

$PersonRepo = new PersonRepository;
$actors = $PersonRepo->getActor();
$directors = $PersonRepo->getDirector();

if (isset($_GET["id"])) {
    $filmID = $_GET["id"];
    $FilmRepo = new FilmRespository;
    $film = $FilmRepo->getByFilmID($filmID);
}

$error = "";

if (isset($_POST["update"])) {
    if (
        empty($_POST["title"]) || empty($_POST["manufacture"]) || empty($_POST["link"])
        || empty($_POST["img"]) || empty($_POST["description"]) || empty($_POST["director"])
        || empty($_POST["actors"]) || empty($_POST["genres"])
    ) { 
        $error = "Please complete all information.";
    } else {

        $film->setTitle($film->getTitle());
        $film->setManufacture($_POST["manufacture"]);
        $film->setLink($_POST["link"]);
        $film->setImg($_POST["img"]);
        $film->setDescription($_POST["description"]);
        $film->removeDirector();
        $director = $PersonRepo->getPersonById($_POST["director"]);
        $film->addDirector($director);

        $film->removeAllActor();
        foreach ($_POST["actors"] as $actorID) {
            $actor = $PersonRepo->getPersonById($actorID);
            $film->addActor($actor);
        }

        $film->removeAllGenre();
        foreach ($_POST["genres"] as $genreID) {
            $genre = $GenreRepo->getById($genreID);
            $film->addGenre($genre);
        }
        $FilmRepo = new FilmRespository;
        $FilmRepo->Update($film);
        $_SESSION["update"] = $film->getTitle(). " updated";
        header("location: index.php");
    } 
} 
   


require_once '..\template\admin\update_movie.phtml';
