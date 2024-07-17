<?php
require_once "../include/inc.php";
$GenreRepo = new GenreRepository;
$genres = $GenreRepo->getAll();
session_start();

if(! isset($_SESSION["name"])) {
    header("location: ../index.php");
}

if (isset($_POST['update']) && isset($_POST['filmID']) && isset($_POST["title"])) {
    $_SESSION["filmID"] = $_POST["filmID"];
    header("location: update_movie.php");
    exit;
}

if (isset($_POST['delete']) && isset($_POST['filmID']) && isset($_POST["title"])) {
    $_SESSION["filmID"] = $_POST["filmID"];
    header("location: delete_movie.php");
    exit;
}

if (isset($_POST["add"])) {
    header("location: add_movie.php");
    exit;
}


if (isset($_GET['id'])) {
    $genreID = $_GET['id'];
    $FilmRepo = new FilmRespository;
    $films = $FilmRepo->getByGenreID($genreID);
}

require_once '..\template\admin\list_movie.phtml';

?>
