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

if (isset($_POST['filmID'])) {
    $_SESSION["filmID"] = $_POST['filmID'];
}

$filmID = (isset($_SESSION["filmID"])) ? $_SESSION["filmID"] : null;

if ($filmID) {
    $FilmRepo = new FilmRespository;
    $film = $FilmRepo->getByFilmID($filmID);
}

$error = "";

if (isset($_POST["update"])) {
    if (
        empty($_POST["manufacture"]) OR empty($_POST["link"])
        OR empty($_POST["img"]) OR empty($_POST["description"]) OR empty($_POST["director"])
        OR empty($_POST["actors"]) OR empty($_POST["genres"])
    ) { echo "haha";
        $error = "Please complete all information.";
    } else {
        $newFilm = new Film();
        $newFilm->setTitle($film->getTitle());
        $newFilm->setManufacture($_POST["manufacture"]);
        $newFilm->setLink($_POST["link"]);
        $newFilm->setImg($_POST["img"]);
        $newFilm->setDescription($_POST["description"]);

        $director = $PersonRepo->getPersonById($_POST["director"]);
        $NewFilm->addDirector($director);

        foreach ($_POST["actors"] as $actorID) {
            $actor = $PersonRepo->getPersonById($actorID);
            $newFilm->addActor($actor);
        }

        foreach ($_POST["genres"] as $genreID) {
            $genre = $GenreRepo->getById($genreID);
            $newFilm->addGenre($genre);
        }
        print_r($newFilm);
        // $FilmRepo = new FilmRespository;
        // $FilmRepo->Update($film);
        // $_SESSION["update"] = $film->getTitle(). " updated";
        // header("location: index.php");
    } 
} 
   


require_once '..\template\admin\update_movie.phtml';
