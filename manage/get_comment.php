<?php
require_once "..\include\inc.php";
$commentRepo = new CommentRepo();

$comments = $commentRepo->getAll();

header('Content-Type: application/json');
echo json_encode($comments);
?>
