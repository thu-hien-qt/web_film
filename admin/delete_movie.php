<?php

require_once "..\include\inc.php";
session_start();
$GenreRepo = new GenreRepository;
$genres = $GenreRepo->getAll();

if (isset($_POST["no"])) {
    unset($_SESSION['delete']);
    header("location: index.php");
}

if (isset($_POST["yes"]) && isset($_SESSION['filmID'])) 
{
    $filmID = $_SESSION['filmID'];
    $FilmRepo = new FilmRepository;
    $film = $FilmRepo->getByFilmID($filmID);
    $FilmRepo->Delete($film);
    $_SESSION["delete"] = $film->getTitle(). " deleted";
    unset($_SESSION['filmID']);
    header("location: index.php");
}

require "../template/admin/delete_movie.phtml"
?>
