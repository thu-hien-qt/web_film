<?php

class FilmRespository
{
    public function getByFilmID($filmID)
    {
        $pdo = MyPDO::getInstance();
        $query = "SELECT 
            film.filmID,
            film.title,
            GROUP_CONCAT(DISTINCT genres.name SEPARATOR ', ') AS genres, 
            film.manufacture, 
            D.name AS director, 
            GROUP_CONCAT(DISTINCT A.name SEPARATOR ', ') AS actors, 
            film.img,
            film.link, 
            film.description 
            FROM 
                film
            JOIN 
                film_genre ON film.filmID = film_genre.filmID
            JOIN 
                genres ON film_genre.genreID = genres.genreID
            JOIN 
                person D ON film.directorID = D.personID
            JOIN 
                film_actor ON film.filmID = film_actor.filmID
            JOIN 
                person A ON film_actor.actorID = A.personID
            WHERE film.filmID = :filmID
            GROUP BY 
                film.title, 
                film.manufacture, 
                film.link, 
                film.description";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['filmID' => $filmID]);

        $row = $stmt->fetchObject();

        if(!$row) {throw new Exception("Film $filmID is not found");
        }

        $film = new Film;
        $film->setFilmID($row->filmID);
        $film->setTitle($row->title);

        $genres = explode(', ', $row->genres);
        foreach ($genres as $genreName) {
            $genre = new Genre;
            $genre->setName($genreName);
            $film->addGenres($genre);
        }

        $film->setManufacture($row->manufacture);

        $director = new Person;
        $director->setName($row->director);
        $film->adddirector($director);

        $actors = explode(',', $row->actors);
        foreach ($actors as $actorName)
        {
            $actor = new Person;
            $actor->setName($actorName);
            $film->addActors($actor);
        }

        $film->setLink($row->link);
        $film->setImg($row->img);
        $film->setDescription($row->description);

        return $film;
    }

    public function getAll()
    {
        $pdo = MyPDO::getInstance();
        $query = "SELECT 
            film.filmID,
            film.title,
            film.manufacture, 
            film.img,
            film.link
            FROM film";
        $stmt = $pdo->query($query);

        $films = [];
        while ($row = $stmt->fetchObject())
        {
            $film = new Film();
            $film->setFilmID($row->filmID);
            $film->setTitle($row->title);
            $film->setManufacture($row->manufacture);
            $film->setImg($row->img);
            $film->setLink($row->link);
            $films[] = $film;
        }
        return $films;

    }

    public function getByGenreID ($genreID)
    {
        $pdo = MyPDO::getInstance();
        $query = "SELECT 
            film.filmID,
            film.title,
            film.manufacture, 
            film.img,
            film.link
            FROM film
            JOIN film_genre ON film_genre.filmID = film.filmID
            JOIN genres ON film_genre.genreID = genres.genreID
            WHERE genres.genreID = :genreID
            GROUP BY film.filmID";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['genreID'=>$genreID]);

        $films = [];
        while($row = $stmt->fetchObject())
        {
            $film = new film();
            $film->setFilmID($row->filmID);
            $film->setTitle($row->title);
            $film->setManufacture($row->manufacture);
            $film->setImg($row->img);
            $film->setLink($row->link);
            $films[] = $film;
        }
        return $films;
    }
    
    public function getByFilm(Film $film)
    {
        $filmID = $film->getFilmID();
        $pdo = MyPDO::getInstance();


        $query =  "SELECT 
        film.filmID,
        film.title,
        film.manufacture, 
        film.img,
        film.link
        FROM film
        JOIN film_genre ON film_genre.filmID = film.filmID
        JOIN genres ON film_genre.genreID = genres.genreID
        WHERE genres.genreID IN (SELECT genres.genreID FROM film
                    JOIN film_genre ON film_genre.filmID = film.filmID
                    JOIN genres ON film_genre.genreID = genres.genreID
                    WHERE film.filmID = :filmID
                    GROUP BY film.filmID)
        GROUP BY film.filmID";
        $stmt2 = $pdo->prepare($query);
        $stmt2->execute([':filmID' => $filmID]);
        $films = [];
        while ($row = $stmt2->fetchObject())
        {
            $film = new Film();
            $film->setFilmID($row->filmID);
            $film->setTitle($row->title);
            $film->setManufacture($row->manufacture);
            $film->setImg($row->img);
            $film->setLink($row->link);
            $films[] = $film;
        }
        return $films;
    }
    
    public function Insert(Film $film)
    {
        $pdo = MyPDO::getInstance();
        $query = "INSERT INTO film  (title, manufacture, directorID, link, description, img) VALUES (:title, :manufacture, :directorID, :link, :description, :img)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':title' => $film->getTitle(),
            ':manufacture' => $film->getManufacture(),
            ':directorID' => $film->getDirector()->getPersonID(),
            ':link' => $film->getLink(),
            ':description' => $film->getDescription(),
            ':img' => $film->getImg()
        ]);

        $sql = "SELECT filmID FROM film WHERE title = :title";
        $statement = $pdo->prepare($sql);
        $statement->execute([':title' => $film->getTitle()]);
        $row = $statement->fetchObject();
        $filmID = $row->filmID;

        foreach($film->getActors() as $actor)
        {
            $query2 = "INSERT INTO film_actor (filmID, actorID) VALUES (:filmID, :actorID)";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->execute([':filmID' => $filmID,
                             ':actorID' => $actor->getPersonID()]);
        }

        foreach ($film->getGenres() as $genre)
        {
            $query3 = "INSERT INTO film_genre (filmID, genreID) VALUES (:filmID, :genreID)";
            $stmt3 = $pdo->prepare($query3);
            $stmt3->execute([':filmID' => $filmID,
                            ':genreID' =>$genre->getGenreID()]);
            
        }

    }

    public function Delete(Film $film)
    {
        $pdo = MyPDO::getInstance();
        
        $query2 = "DELETE FROM film_genre WHERE filmID = :filmID";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute([':filmID' => $film->getFilmID()]);

        $query3 = "DELETE FROM film_actor WHERE filmID = :filmID";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->execute([':filmID' => $film->getFilmID()]);

        $query = "DELETE FROM film WHERE filmID = :filmID";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':filmID' => $film->getFilmID()]);

    }

    public function Update(Film $film)
    {
        $pdo = MyPDO::getInstance();

        $query2 = "DELETE FROM film_genre WHERE filmID = :filmID";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute([':filmID' => $film->getFilmID()]);

        $query3 = "DELETE FROM film_actor WHERE filmID = :filmID";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->execute([':filmID' => $film->getFilmID()]);

        $query = "UPDATE film SET title = :title, manufacture = :manufactor, directorID = :directorID, link = :link, description = :description, img = :img";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':title' => $film->getTitle(),
            ':manufacture' => $film->getManufacture(),
            ':directorID' => $film->getDirector()->getPersonID(),
            ':link' => $film->getLink(),
            ':description' => $film->getDescription(),
            ':img' => $film->getImg()
        ]);

        foreach($film->getActors() as $actor)
        {
            $query2 = "INSERT INTO film_actor (filmID, actorID) VALUES (:filmID, :actorID)";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->execute([':filmID' => $film->getFilmID(),
                             ':actorID' => $actor->getPersonID()]);
        }

        foreach ($film->getGenres() as $genre)
        {
            $query3 = "INSERT INTO film_genre (filmID, genreID) VALUES (:filmID, :genreID)";
            $stmt3 = $pdo->prepare($query3);
            $stmt3->execute([':filmID' => $film->getFilmID(),
                            ':genreID' =>$genre->getGenreID()]);
            
        }

    }

}
