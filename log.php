<?php
require_once "C:/xampp/htdocs/test/phim/include/pdo.php";
session_start();
$statement1 = $pdo->query('SELECT name FROM genres');



if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "SELECT name FROM users WHERE username = '$username' AND password = '$password'";
    $statement = $pdo->query($query);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if (empty($row)) {
        echo "Incorrect password";
    } else {
    $_SESSION["name"] = $row["name"];
    header("location:admin\login.php");
    }
} 
require_once 'C:\xampp\htdocs\test\phim\template\public\log.phtml';

?>
