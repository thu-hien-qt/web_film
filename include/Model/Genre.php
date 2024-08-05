<?php
namespace App\Model;

class Genre
{
    private $genreID;
    private $name;

    public function getGenreID()
    {
        return $this->genreID;
    }

    public function setGenreID($genreID)
    {
        $this->genreID = $genreID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}