<?php

require_once "../include/inc.php";
session_start();
$GenreRepo = new GenreRepository;
$genres = $GenreRepo->getAll();

$PersonRepo = new PersonRepository;
$actors = $PersonRepo->getActors();
$directors = $PersonRepo->getDirectors();

$error = "";

if (isset($_POST["addNew"])) {
    if (
        empty($_POST["title"]) || empty($_POST["manufacture"]) || empty($_POST["link"])
        || empty($_POST["img"]) || empty($_POST["description"]) || empty($_POST["director"])
        || empty($_POST["actors"]) || empty($_POST["genres"])
    ) {
        $error = "Please complete all information.";
    } else {
        $film = new Film();
        $film->setTitle($_POST["title"]);
        $film->setManufacture($_POST["manufacture"]);
        $film->setLink($_POST["link"]);
        $film->setImg($_POST["img"]);
        $film->setDescription($_POST["description"]);

        $director = $PersonRepo->getPersonById($_POST["director"]);
        $film->addDirector($director);

        foreach ($_POST["actors"] as $actorID) {
            $actor = $PersonRepo->getPersonById($actorID);
            $film->addActor($actor);
        }

        foreach ($_POST["genres"] as $genreID) {
            $genre = $GenreRepo->getById($genreID);
            $film->addGenre($genre);
        }

        $FilmRepo = new FilmRepository;
        $FilmRepo->insert($film);

        header('location: index.php');

    } 
} 

require_once "../template/admin/add_movie.phtml";
