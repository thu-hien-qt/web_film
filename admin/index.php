<?php 
require_once "../include/inc.php";
session_start();

$kernel = new \Kernel\Kernel();
$kernel->run('admin');



//if(! isset($_SESSION["name"])) {
//    header("location: ../index.php");
//}
//
//if (isset($_POST['genre'])) {
//    $_SESSION["genre"] = $_POST["genre"];
//    header("location: list_movie.php");
//}
//
//if (isset($_POST["add"])) {
//    header("location: add_movie.php");
//    exit;
//}
//
//
//if (isset($_POST["update"]) && isset($_POST['filmID']) ) {
//    $_SESSION["filmID"] = $_POST["filmID"];
//    header("location: update_movie.php");
//    exit;
//}
//
//if (isset($_POST['delete'])  && isset($_POST['filmID']) ) {
//    $_SESSION["filmID"] = $_POST["filmID"];
//    header("location: delete_movie.php");
//    exit;
//}




?>
