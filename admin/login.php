<?php
require_once "../include/pdo.php";
session_start();
$statement1 = $pdo->query('SELECT name FROM genres');

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query = "SELECT name FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(
        ':username' => $_POST["username"],
        ':password' => $_POST["password"],
    ));
    $user= $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($user);
    if (empty($user)) {
        echo "Incorrect password";
    } else {
    $_SESSION["name"] = $user["name"];
    header("location:index.php");
    }
} 
require_once '..\template\admin\login.phtml';

?>
