<?php 
require_once "include/inc.php";
session_start();

$kernel = new \Kernel\Kernel();
$kernel->run();

//unset($_SESSION["name"]);
//$GenreRepo = new GenreRepository;
//$genres = $GenreRepo->getAll();
//
//$FilmRepo = new FilmRepository;
//$films = $FilmRepo->getAll();
//
//require_once "template/public/index.phtml";

?>
