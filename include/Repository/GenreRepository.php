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
        $pdo = MyPDO::getInstance();
        $query = 'INSERT INTO genres (name) VALUES (:genre)';
        $stmt = $pdo->prepare($query);
        $stmt->execute([":genre" => $genre->getName()]);
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