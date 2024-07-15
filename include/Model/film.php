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

    public function addActors(Person $actor)
    {
        $this->actors[] = $actor;
    }

    public function getActors()
    {
        $actors = [];
        foreach ($this->actors as $actor) {
            $actors[] = $actor;
        }
        return $actors;
    }


    public function addGenres(Genre $genre)
    {
        $this->genres[] = $genre;
    }

    public function getGenres()
    {
        $genres = [];
        foreach ($this->genres as $genre) {
            $genres[] = $genre;
        }
        return $genres;
    }

    public function addDirector(Person $director)
    {
        $this->director = $director;
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