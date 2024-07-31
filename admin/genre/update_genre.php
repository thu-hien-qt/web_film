<?php
require_once "../../include/inc.php";
$genreRepo = new GenreRepository;

if (isset($_GET["genreID"])) {
    $genreID = $_GET["genreID"];
    $genre = $genreRepo->getById($genreID);
} else {
    echo "error";
}
 
if (isset($_POST["submit"]) && isset($_POST["name"])) {
    $genre->setName($_POST["name"]);
    $genreRepo->update($genre);
    header("location: ../../admin/list_movie.php?address=genre");
}
require_once '..\..\template\admin\genre\update_genre.phtml';

