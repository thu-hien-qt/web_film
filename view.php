<?php
require_once "include/pdo.php";
$statement1 = $pdo->query('SELECT name FROM genres');
session_start();

$filmID = (isset($_GET["id"])) ? $_GET["id"] : null;

if ($filmID) {
    $stmt = $pdo->prepare("SELECT 
    film.filmID,
    film.title,
    GROUP_CONCAT(DISTINCT genres.name SEPARATOR ', ') AS genres, 
    film.manufacture, 
    D.name AS director, 
    GROUP_CONCAT(DISTINCT A.name SEPARATOR ', ') AS actors, 
    film.link, 
    film.description 
FROM 
    film
JOIN 
    film_genre ON film.filmID = film_genre.filmID
JOIN 
    genres ON film_genre.genreID = genres.genreID
JOIN 
    person D ON film.directorID = D.personID
JOIN 
    film_actor ON film.filmID = film_actor.filmID
JOIN 
    person A ON film_actor.actorID = A.personID
WHERE film.filmID = :filmID
GROUP BY 
    film.title, 
    film.manufacture, 
    film.link, 
    film.description;");
$stmt->execute(array(":filmID"=>$filmID));
$film = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['genre'])) {
    $_SESSION["genre"] = $_POST["genre"];
    header("location: category.php");
}

$url = $film["link"];
function getYouTubeID($url) {
    $urlComponents = parse_url($url);

    if (!isset($urlComponents['query'])) {
        return null;
    }

    parse_str($urlComponents['query'], $queryParams);

    if (isset($queryParams['v'])) {
        return $queryParams['v'];
    }

    return null; 
}

$videoID = getYouTubeID($url);

$stmt = $pdo->query("SELECT 
    film.filmID,
    film.title,
    film.manufacture, 
    film.img
FROM 
    film
");

require_once "template/public/view.phtml"
?>