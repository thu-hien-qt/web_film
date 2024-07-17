<?php
require_once "../include/inc.php";
session_start();
$GenreRepo = new GenreRepository;
$genres = $GenreRepo->getAll();

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $userName = $_POST["username"];
    $password = $_POST["password"];
    $userRepo = new UserReposiroty;
    $user = $userRepo->getUser($userName, $password);
    
    if (empty($user)) {
        $error = "In correct password";
    } else {
        $_SESSION["name"] = $user->getName();
        header("location:index.php");
    }
} 
require_once '..\template\admin\login.phtml';

?>
