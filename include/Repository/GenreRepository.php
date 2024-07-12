<?php

class GenreRepository
{
    public function getAll()
    {
        $pdo = MyPDO::getInstance();
        $query = 'SELECT * FROM genres';
        $data = $pdo->query($query);

        $genres = [];
        while ($row = $data->fetchObject()) {
            $genre = new Genre();
            $genre->setGenreID($row->genreID);
            $genre->setName($row->name);
            $genres[] = $genre;
        }

        return $genres;
    }

    public function getById($id)
    {
        $pdo = MyPDO::getInstance();
        $query = 'SELECT * FROM genres WHERE genreID = :id';
        $statment = $pdo->prepare($query);
        $statment->execute([":id" => $id]);
        $row = $statment->fetchObject();

        if (empty($row)) {
            throw new Exception("Genre $id not found");
        }

        $genre = new Genre();
        $genre->setGenreID($row->genreID);
        $genre->setName($row->name);

        return $genre;
    }

    public function insert(Genre $genre)
    {

    }

    public function update(Genre $genre)
    {

    }


    public function delete(Genre $genre)
    {

    }

}