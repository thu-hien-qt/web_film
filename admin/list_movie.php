<?php
require_once "../include/inc.php";

session_start();

if (!isset($_SESSION["name"])) {
    header("location: ../index.php");
}


if (isset($_GET['address'])) {
    if ($_GET['address'] == 'genre') {
        $GenreRepo = new GenreRepository;
        $genres = $GenreRepo->getAll();
    } elseif ($_GET["address"] == 'person') {
        $PersonRepo = new PersonRepository;
        $people = $PersonRepo->getAll();
    } elseif ($_GET["address"] == 'user') {
        $UserRepo = new UserReposiroty;
        $users = $UserRepo->getAll();
    }
}
require_once '..\template\admin\list_movie.phtml';
