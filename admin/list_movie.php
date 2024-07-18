<?php
require_once "../include/inc.php";

session_start();

if(! isset($_SESSION["name"])) {
    header("location: ../index.php");
}


if (isset($_GET['id'])) {
    if ($_GET['id'] == 1) {
    $GenreRepo = new GenreRepository;
    $genres = $GenreRepo->getAll();

} elseif($_GET["id"] == 2) {
    $PersonRepo = new PersonRepository;
    $people = $PersonRepo->getAll();

} elseif ($_GET["id"] == 3) {
    $UserRepo = new UserReposiroty;
    $users = $UserRepo->getAll();

}
}
require_once '..\template\admin\list_movie.phtml';

?>
