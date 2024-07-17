<?php 
require_once "include/inc.php";
session_start();
unset($_SESSION["name"]);
$GenreRepo = new GenreRepository;
$genres = $GenreRepo->getAll();

$FilmRepo = new FilmRespository;
$films = $FilmRepo->getAll();

require_once "template/public/index.phtml";

?>
