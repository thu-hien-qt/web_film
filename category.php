<?php
require_once "C:/xampp/htdocs/test/phim/include/pdo.php";
$statement1 = $pdo->query('SELECT name FROM genres');
session_start();

if (isset($_SESSION['genre'])) {
    $genre = $_SESSION['genre'];
    unset($_SESSION["genre"]);
    $sql = "SELECT 
        film.filmID,
        film.title,
        film.manufacture, 
        film.img
        FROM film
        JOIN film_genre ON film.filmID = film_genre.filmID
        JOIN genres ON film_genre.genreID = genres.genreID
        WHERE genres.name = '$genre'";
    $statement2 = $pdo->query($sql);
}

if (isset($_POST['genre'])) {
    $_SESSION["genre"] = $_POST["genre"];
    header("location: category.php");
}

require_once 'template/public/catelogy.phtml';

?>
1