<?php

require_once "../include/pdo.php";
session_start();

$statement1 = $pdo->query('SELECT filmID, title  FROM film');
$statement2 = $pdo->query('SELECT personID, name FROM person WHERE `role` lIKE "actor"');
$statement3 = $pdo->query('SELECT personID, name FROM person WHERE `role` lIKE "director"');
$statement4 = $pdo->query('SELECT genreID, name  FROM genres');
$statement5 = $pdo->query('SELECT genreID, name  FROM genres');

if (isset($_SESSION['filmID'])) {
    $filmID = $_SESSION['filmID'];
}

if (isset($_SESSION['title'])) {
    $title = $_SESSION['title'];
    
}

$statement5 = $pdo->query("SELECT 
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
WHERE film.filmID = $filmID
GROUP BY 
    film.title, 
    film.manufacture, 
    film.link, 
    film.description;
");
$row5 = $statement5->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['manufacture']) && isset($_POST['director']) && isset($_POST['link']) && isset($_POST['description'])) {
    $sqlf = "UPDATE film
        SET manufacture = :manufacture, 
            directorID = :directorID,
            link = :link,
            description = :description
        WHERE filmID = :filmID";
    $stmtf = $pdo->prepare($sqlf);
    $stmtf->execute(array(
        ':manufacture' => $_POST['manufacture'],
        ':directorID' => $_POST['director'],
        ':link' => $_POST['link'],
        ':description' => $_POST['description'],
        ':filmID' => $filmID
    ));
} 

if (isset($_POST["actors"])) {

    $sqla = "DELETE FROM film_actor WHERE filmID = :f";
    $stmta = $pdo->prepare($sqla);
    $stmta->execute(array(':f' => $filmID));

    foreach ($_POST["actors"] as $actorID) {
        $sql1 = "INSERT INTO film_actor (filmID, actorID)
        VALUES (:filmID, :actorID)";

        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute(array(
            ':filmID' => $filmID,
            ':actorID' => $actorID
        ));
    }
}

if (isset($_POST["genres"])) {

    $sqlg = "DELETE FROM film_genre WHERE filmID = :f";

    $stmtg = $pdo->prepare($sqlg);
    $stmtg->execute(array(':f' => $filmID));

    foreach ($_POST["genres"] as $genreID) {
        $sql2 = "INSERT INTO film_genre (filmID, genreID)
    VALUES (:filmID, :genreID)";

        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute(array(
            ':filmID' => $filmID,
            ':genreID' => $genreID
        ));
    }
}


if (isset($_POST['update'])) {
    $_SESSION['update'] = $_SESSION['title']. " updated";
    unset($_SESSION["title"]);
    header("location: login.php");
}

require_once '..\template\admin\update_movie.phtml';
?>