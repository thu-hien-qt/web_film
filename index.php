<?php 
require_once "include/inc.php";
session_start();
unset($_SESSION["name"]);
$GenreRepo = new GenreRepository;
$genres = $GenreRepo->getAll();

$FilmRepo = new FilmRespository;
$films = $FilmRepo->getAll();

if (isset($_POST['genre'])) {
    $_SESSION["genre"] = $_POST["genre"];
    header("location: category.php");
}

require_once "template/public/index.phtml";

?>
