<?php 
require_once "include/inc.php";
session_start();
unset($_SESSION["name"]);
$GenreRepo = new GenreRepository;
$genres = $GenreRepo->getAll();

$FilmRepo = new FilmRepository;
$films = $FilmRepo->getAll();

require_once "template/public/index.phtml";

?>
