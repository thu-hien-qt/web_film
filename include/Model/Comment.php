<?php 
namespace App\Model;

class Comment {
    private $ID;
    private $filmID;
    private $comment;
    private $datetime;

    public function setID($ID) 
    {
        $this->ID = $ID;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setFilmID($filmID)
    {
        $this->filmID = $filmID;
    }

    public function getFilmID()
    {
        return $this->filmID;
    }

    public function setComment($comment) 
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }
}