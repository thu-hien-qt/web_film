<?php

class Film
{
    private $filmID;
    private $title;
    private $manufacture;
    private $actors = [];
    private $genres = [];
    private $director;
    private $link;
    private $img;
    private $description;

    public function __construct($data = null)
    {
        if ($data) {
            $this->setFilmID($data->filmID);
            $this->setTitle($data->title);
            $this->setManufacture($data->manufacture);
            $this->setImg($data->img);
            $this->setLink($data->link);
            $this->setDescription($data->description);
        }
    }

    public function getFilmID()
    {
        return $this->filmID;
    }

    public function setFilmID($filmID)
    {
        $this->filmID = $filmID;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getManufacture()
    {
        return $this->manufacture;
    }

    public function setManufacture($manufacture)
    {
        $this->manufacture = $manufacture;
    }

    public function addActor(Person $actor)
    {
        $this->actors[] = $actor;
    }

    public function getActors()
    {
        return $this->actors;
    }

    public function removeAllActor()
    {
        $this->actors = [];
    }

    public function addGenre(Genre $genre)
    {
        $this->genres[] = $genre;
    }

    public function removeAllGenre()
    {
        $this->genres = [];
    }

    public function getGenres()
    {
        return $this->genres;
    }

    public function addDirector(Person $director)
    {
        $this->director = $director;
    }

    public function removeDirector()
    {
        $this->director = null;
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
