<?php 
require_once "C:/xampp/htdocs/test/phim/include/pdo.php";
$statement1 = $pdo->query('SELECT name FROM genres');
session_start();
unset($_SESSION["name"]);

$statement2 = $pdo->query("SELECT 
    film.filmID,
    film.title,
    film.manufacture, 
    film.img
FROM 
    film
");

if (isset($_POST['genre'])) {
    $_SESSION["genre"] = $_POST["genre"];
    header("location: category.php");
}

require_once "template/public/index.phtml";

?>
