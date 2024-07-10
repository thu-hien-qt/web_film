<?php 
require_once "C:/xampp/htdocs/test/phim/include/pdo.php";
$statement1 = $pdo->query('SELECT name FROM genres');
session_start();

if(! isset($_SESSION["name"])) {
    header("location: ../index.php");
}

if (isset($_POST['genre'])) {
    $_SESSION["genre"] = $_POST["genre"];
    header("location: list_movie.php");
}

if (isset($_POST["add"])) {
    header("location: add_movie.php");
    exit;
}


if (isset($_POST["update"])&& isset($_POST['filmID']) && isset($_POST["title"])) {
    $_SESSION["title"] = $_POST["title"];
    $_SESSION["filmID"] = $_POST["filmID"];
    header("location: update_movie.php");
    exit;
}

if (isset($_POST['delete'])  && isset($_POST['filmID']) && isset($_POST["title"])) {
    $_SESSION["title"] = $_POST["title"];
    $_SESSION["filmID"] = $_POST["filmID"];
    header("location: delete_movie.php");
    exit;
}

$statement2 = $pdo->query("SELECT 
    film.filmID,
    film.title,
    film.manufacture, 
    film.img
FROM 
    film
");



require_once 'C:\xampp\htdocs\test\phim\template\admin\login.phtml';
?>
