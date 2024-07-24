<?php
require 'C:\xampp\htdocs\test\phim\include\inc.php';
$commentRepo = new CommentRepository();

$comments = $commentRepo->getAll();

$commentsArray = array_map(function($comment) {
    return [
        'ID' => $comment->getID(),
        'filmID' => $comment->getFilmID(),
        'comment' => $comment->getComment(),
        'datetime' => $comment->getDatetime()
    ];
}, $comments);

header('Content-Type: application/json');
echo json_encode($commentsArray);
?>
