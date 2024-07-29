<?php
require_once "include/inc.php";
session_start();

$GenreRepo = new GenreRepository;
$genres = $GenreRepo->getAll();

if (isset($_GET['id'])) {
    $genreID = $_GET['id'];
    $FilmRepo = new FilmRepository;
    $films = $FilmRepo->getByGenreID($genreID);
}

require_once 'template\public\category.phtml';

?>
