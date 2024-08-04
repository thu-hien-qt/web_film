<?php
require 'C:\xampp\htdocs\test\phim\include\inc.php';
$commentRepo = new CommentRepository();
$comments = $commentRepo->getAll();

$commentsArray = [];
foreach ($comments as $comment) {
    $commentsArray[] = (array)$comment;
}

header('Content-Type: application/json');
echo json_encode($commentsArray);
?>
