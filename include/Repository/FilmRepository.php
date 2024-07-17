<?php

class FilmRespository
{
    public function getByFilmID($filmID)
    {
        $pdo = MyPDO::getInstance();
        $query = "SELECT * FROM film WHERE film.filmID = :filmID ";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['filmID' => $filmID]);
        $row = $stmt->fetchObject();

        if (!$row) {
            throw new Exception("Film $filmID is not found");
        }

        $film = new Film($row);

        $sql1 = "SELECT person.personID, person.name, person.gender, person.birthday, person.role FROM person
            JOIN film_actor ON film_actor.actorID = person.personID
            JOIN film ON film.filmID = film_actor.filmID 
            WHERE film.filmID = :filmID AND person.role = 'actor'";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute([":filmID" => $filmID]);
        while ($row1 = $stmt1->fetchObject()) {
            $person = new Person($row1);
            $film->addActor($person);
        }


        $sql2 = "SELECT genres.genreID, genres.name FROM genres 
                JOIN film_genre ON film_genre.genreID = genres.genreID
                JOIN film ON film.filmID = film_genre.filmID
                WHERE film.filmID = :filmID";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([':filmID' => $filmID]);
        while ($row2 = $stmt2->fetchObject()) {
            $genre = new genre();
            $genre->setGenreID($row2->genreID);
            $genre->setName($row2->name);
            $film->addGenre($genre);
        }

        $sql3 = "SELECT person.personID, person.name, person.gender, person.birthday, person.role FROM person 
                JOIN film ON film.directorID = person.personID
                WHERE film.filmID = :filmID";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->execute([':filmID' => $filmID]);
        $row3 = $stmt3->fetchObject();
        $director = new Person($row3);
        $film->addDirector($director);

        return $film;
    }

    public function getAll()
    {
        $pdo = MyPDO::getInstance();
        $query = "SELECT * FROM film";
        $stmt = $pdo->query($query);

        $films = [];
        while ($row = $stmt->fetchObject()) {
            $film = new Film($row);

            $sql1 = "SELECT person.personID, person.name, person.gender, person.birthday, person.role FROM person
                    JOIN film_actor ON film_actor.actorID = person.personID
                    JOIN film ON film.filmID = film_actor.filmID 
                    WHERE film.filmID = :filmID AND person.role = 'actor'";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute([":filmID" => $row->filmID]);
            while ($row1 = $stmt1->fetchObject()) {
                $person = new Person($row1);
                $film->addActor($person);
            }

            $sql2 = "SELECT genres.genreID, genres.name FROM genres 
                    JOIN film_genre ON film_genre.genreID = genres.genreID
                    JOIN film ON film.filmID = film_genre.filmID
                    WHERE film.filmID = :filmID";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute([':filmID' => $row->filmID]);
            while ($row2 = $stmt2->fetchObject()) {
                $genre = new genre();
                $genre->setGenreID($row2->genreID);
                $genre->setName($row2->name);
                $film->addGenre($genre);
            }

            $sql3 = "SELECT person.personID, person.name, person.gender, person.birthday, person.role FROM person 
                    JOIN film ON film.directorID = person.personID
                    WHERE film.filmID = :filmID";
            $stmt3 = $pdo->prepare($sql3);
            $stmt3->execute([':filmID' => $row->filmID]);
            $row3 = $stmt3->fetchObject();
            $director = new Person($row3);
            $film->addDirector($director);

            $films[] = $film;
        }
        return $films;
    }

    public function getByGenreID($genreID)
    {
        $pdo = MyPDO::getInstance();
        $query = "SELECT film.filmID, title, manufacture, img, link, description
            FROM film
            JOIN film_genre ON film_genre.filmID = film.filmID
            JOIN genres ON film_genre.genreID = genres.genreID
            WHERE genres.genreID = :genreID
            GROUP BY film.filmID";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['genreID' => $genreID]);

        $films = [];
        while ($row = $stmt->fetchObject()) {
            $film = new film($row);

            $sql1 = "SELECT person.personID, person.name, person.gender, person.birthday, person.role FROM person
                    JOIN film_actor ON film_actor.actorID = person.personID
                    JOIN film ON film.filmID = film_actor.filmID 
                    WHERE film.filmID = :filmID AND person.role = 'actor'";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->execute([":filmID" => $row->filmID]);
            while ($row1 = $stmt1->fetchObject()) {
                $person = new Person($row1);
                $film->addActor($person);
            }

            $sql2 = "SELECT genres.genreID, genres.name FROM genres 
                    JOIN film_genre ON film_genre.genreID = genres.genreID
                    JOIN film ON film.filmID = film_genre.filmID
                    WHERE film.filmID = :filmID";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->execute([':filmID' => $row->filmID]);
            while ($row2 = $stmt2->fetchObject()) {
                $genre = new genre();
                $genre->setGenreID($row2->genreID);
                $genre->setName($row2->name);
                $film->addGenre($genre);
            }

            $sql3 = "SELECT person.personID, person.name, person.gender, person.birthday, person.role FROM person 
                    JOIN film ON film.directorID = person.personID
                    WHERE film.filmID = :filmID";
            $stmt3 = $pdo->prepare($sql3);
            $stmt3->execute([':filmID' => $row->filmID]);
            $row3 = $stmt3->fetchObject();
            $director = new Person($row3);
            $film->addDirector($director);

            $films[] = $film;
        }
        return $films;
    }

    public function getByGenreOfFilm(Film $film)
    {
        $filmID = $film->getFilmID();
        $pdo = MyPDO::getInstance();


        $query =  "SELECT film.filmID, title, manufacture, img, link, description
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
        while ($row = $stmt2->fetchObject()) {
            $film = new Film($row);
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

        foreach ($film->getActors() as $actor) {
            $query2 = "INSERT INTO film_actor (filmID, actorID) VALUES (:filmID, :actorID)";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->execute([
                ':filmID' => $filmID,
                ':actorID' => $actor->getPersonID()
            ]);
        }

        foreach ($film->getGenres() as $genre) {
            $query3 = "INSERT INTO film_genre (filmID, genreID) VALUES (:filmID, :genreID)";
            $stmt3 = $pdo->prepare($query3);
            $stmt3->execute([
                ':filmID' => $filmID,
                ':genreID' => $genre->getGenreID()
            ]);
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

        $query = "UPDATE film SET title = :title, manufacture = :manufacture, directorID = :directorID, link = :link, description = :description, img = :img
                WHERE film = :filmID";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':filmID' => $film->getFilmID(),
            ':title' => $film->getTitle(),
            ':manufacture' => $film->getManufacture(),
            ':directorID' => $film->getDirector()->getPersonID(),
            ':link' => $film->getLink(),
            ':description' => $film->getDescription(),
            ':img' => $film->getImg()
        ]);

        foreach ($film->getActors() as $actor) {
            $query2 = "INSERT INTO film_actor (filmID, actorID) VALUES (:filmID, :actorID)";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->execute([
                ':filmID' => $film->getFilmID(),
                ':actorID' => $actor->getPersonID()
            ]);
        }

        foreach ($film->getGenres() as $genre) {
            $query3 = "INSERT INTO film_genre (filmID, genreID) VALUES (:filmID, :genreID)";
            $stmt3 = $pdo->prepare($query3);
            $stmt3->execute([
                ':filmID' => $film->getFilmID(),
                ':genreID' => $genre->getGenreID()
            ]);
        }
    }
}
