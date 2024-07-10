<?php

require_once "..\include\pdo.php";
session_start();
$statement1 = $pdo->query('SELECT name FROM genres');

if (isset($_POST["no"])) {
    unset($_SESSION['delete']);
    header("location: login.php");
}

if (isset($_POST["yes"])) {
    $sql1 = "DELETE FROM film_actor WHERE filmID = :f";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(array(':f' => $_SESSION['filmID']));

    $sql2 = "DELETE FROM film_genre WHERE filmID = :g";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(array(':g' => $_SESSION['filmID']));

    $sql = "DELETE FROM film WHERE filmID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_SESSION['filmID']));
    unset($_SESSION["filmID"]);
    $_SESSION['del'] = $_SESSION ['title'] . " deleted";
    unset($_SESSION['title']);
    header("location: ../index.php");
}

require "../template/admin/delete_movie.phtml"
?>
