<?php

class Genre
{
    private $genreID;
    private $name;

    /**
     * @return mixed
     */
    public function getGenreID()
    {
        return $this->genreID;
    }

    /**
     * @param mixed $genreID
     */
    public function setGenreID($genreID)
    {
        $this->genreID = $genreID;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}