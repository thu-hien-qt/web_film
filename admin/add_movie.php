<?php

require_once "../include/pdo.php";
session_start();

$statement1 = $pdo->query('SELECT filmID, title  FROM film');
$statement2 = $pdo->query('SELECT personID, name FROM person WHERE `role` lIKE "actor"');
$statement3 = $pdo->query('SELECT personID, name FROM person WHERE `role` lIKE "director"');
$statement4 = $pdo->query('SELECT genreID, name  FROM genres');
$statement5 = $pdo->query('SELECT genreID, name  FROM genres');

if (
    isset($_POST['title'])
    && isset($_POST['manufacture']) && isset($_POST['director']) 
    && isset($_POST['link']) && isset($_POST['img']) && isset($_POST['description'])
) {
    $sql = "INSERT INTO film (title, manufacture, directorID, link, description, img)
        VALUES (:title, :manufacture, :directorID, :link, :description,:img)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':title' => $_POST['title'],
        ':manufacture' => $_POST['manufacture'],
        ':directorID' => $_POST['director'],
        ':link' => $_POST['link'],
        ':description' => $_POST['description'],
        ':img' => $_POST['img'],
    ));
    echo $sql;
    $_SESSION["success"] = 'Film '. $_POST["title"] . ' added';
}

if (isset($_POST["title"])) {
    $statement = $pdo->query('SELECT filmID, title  FROM film');
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        if ($row["title"] == $_POST["title"]) {
            $filmID = $row["filmID"];
        }
    };
}

if (isset($_POST["genres"])) {

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

if (isset($_POST["actors"])) {

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
 
if (isset($_POST["addNew"])) {
    header('location: index.php');
}

require_once "../template/admin/add_movie.phtml";
?>