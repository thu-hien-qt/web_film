<?php
namespace App\Repository;

use App\Model\Film;
use App\Model\Genre;
use App\MyPDO;

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
            throw new \Exception("Genre $id not found");
        }

        $genre = new Genre();
        $genre->setGenreID($row->genreID);
        $genre->setName($row->name);

        return $genre;
    }

    public function getByFilm(Film $film) {
        $pdo = MyPDO::getInstance();
        $sql = "SELECT genres.genreID, genres.name FROM genres 
                JOIN film_genre ON film_genre.genreID = genres.genreID
                JOIN film ON film.filmID = film_genre.filmID
                WHERE film.filmID = :filmID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':filmID' => $film->getFilmID()]);
        $genres = [];
        while ($row2 = $stmt->fetchObject()) {
            $genre = new genre();
            $genre->setGenreID($row2->genreID);
            $genre->setName($row2->name);
            $genres[] = $genre;
        }
        return $genres;
    }

    public function insert(Genre $genre)
    {
        $pdo = MyPDO::getInstance();
        $query = 'INSERT INTO genres (name) VALUES (:genre)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([":genre" => $genre->getName()]);
        $genreID = $pdo->lastInsertId();
        return $genreID;
    }

    public function update(Genre $genre)
    {
        $pdo = MyPDO::getInstance();
        $query = 'UPDATE genres SET name = :name WHERE genreID = :genreID';
        $stmt = $pdo->prepare($query);
        $stmt->execute([':name'=> $genre->getName(),
                        ':genreID' => $genre->getGenreID()]);
    }


    public function delete(Genre $genre)
    {
        $pdo = MyPDO::getInstance();
        $query = 'DELETE FROM genres WHERE genreID = :genreID';
        $stmt = $pdo->prepare($query);
        $stmt->execute([':genreID'=> $genre->getGenreID()]);
    }

}