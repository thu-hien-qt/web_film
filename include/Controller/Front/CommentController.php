<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Model\Comment;
use App\Repository\CommentRepository;

class CommentController extends AbstractController
{
    public function getComment()
    {
        require 'C:\xampp\htdocs\test\phim\include\inc.php';
        $commentRepo = new CommentRepository();
        $comments = $commentRepo->getAll();
        $commentsArray = [];
        foreach ($comments as $comment) {
            $commentsArray[] = array(
                "ID" => $comment->getID(),
                "filmID" => $comment->getFilmID(),
                "comment" => $comment->getComment(),
                "datetime" => $comment->getDatetime()
            );
        }
        header('Content-Type: application/json');
        echo json_encode($commentsArray);
    }

    public function postComment()
    {
        $commentRepo = new CommentRepository();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $filmID = $_POST['filmID'];
            $commentText = $_POST['comment'];
            $cmt = new Comment();
            $cmt->setFilmID($filmID);
            $cmt->setComment($commentText);
            $datetime = new \DateTime();
            $datetime->setTimezone(new \DateTimeZone('Asia/Ho_Chi_Minh'));
            $currentDateTime = $datetime->format('Y-m-d H:i:s');
            $cmt->setDatetime($currentDateTime);
            $commentRepo->insertCmt($cmt);

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }
}
