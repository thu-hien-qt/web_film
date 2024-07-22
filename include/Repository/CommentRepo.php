<?php

class CommentRepo
{
    public function getAll()
    {
        $pdo = MyPDO::getInstance();
        $query = "SELECT * FROM comments ORDER BY datetime";
        $stmt = $pdo->query($query);
        $cmts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $cmts = [];
        // while ($row = $stmt->fetchObject())
        // {
        //     $cmt = new Comment;
        //     $cmt->setID($row->ID);
        //     $cmt->setFilmID($row->filmID);
        //     $cmt->setComment($row->comment);
        //     $cmt->setDatetime($row->datetime);
        //     $cmts[] = $cmt;
        // }
        return $cmts;
    }

    public function insertCmt(Comment $cmt)
    {
        $pdo = MyPDO::getInstance();
        $query = "INSERT INTO comments (filmID, comment, datetime) VALUES (:filmID, :comment, :datetime)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':filmID'=>$cmt->getFilmID(),
            ':comment'=>$cmt->getComment(),
            ':datetime'=>$cmt->getDatetime()
        ]);
    }

    public function deleteCmt(Comment $cmt)
    {
        $pdo = MyPDO::getInstance();
        $query = "DELETE FROM comments WHERE ID = :ID";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':ID'=>$cmt->getID()]);
    }

    public function updateCmt(Comment $cmt)
    {
        $pdo = MyPDO::getInstance();
        $query = "UPDATE comments SET filmID = :filmID, comment = :comment, datetime = :datetime, WHERE ID = :ID ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':ID'=>$cmt->getID(),
            ':filmID'=>$cmt->getFilmID(),
            ':comment'=>$cmt->getComment(),
            ':datetime'=>$cmt->getDatetime()
        ]);
    }
}