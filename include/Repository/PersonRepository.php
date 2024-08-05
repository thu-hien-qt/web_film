<?php
namespace App\Repository;

use App\Model\Film;
use App\Model\Person;
use App\MyPDO;

class PersonRepository 
{
    public function getAll()
    {
        $pdo = MyPDO::getInstance();
        $query = 'SELECT * FROM person';
        $stmt = $pdo->query($query);

        $people = [];
        while ($row = $stmt->fetchObject()) 
        {
            $people[] = new Person($row);
        }
        return $people;

    }

    public function getActors()
    {
        $pdo = MyPDO::getInstance();
        $query = 'SELECT * FROM person WHERE role = "actor"';
        $stmt = $pdo->query($query);

        $actors = [];
        while ($row = $stmt->fetchObject()) 
        {
            $actors[] = new Person($row);
        }
        return $actors;

    }

    public function getDirectors()
    {
        $pdo = MyPDO::getInstance();
        $query = 'SELECT * FROM person WHERE role = "director"';
        $stmt = $pdo->query($query);

        $directors = [];
        while ($row = $stmt->fetchObject())
        {
            $directors[] = new Person($row);
        }
        return $directors;
    }

    public function getPersonById($personID)
    {
        $pdo = MyPDO::getInstance();
        $query = 'SELECT * FROM person WHERE personID = :id';
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id'=>$personID]);
        $row = $stmt->fetchObject();

        if (empty($row)) {
            throw new \Exception("Person $personID not found");
        }

        $person = new Person($row);
        return $person;
    }

    public function getActorbyFilm(Film $film) {
        $pdo = MyPDO::getInstance();
        $sql = "SELECT person.personID, person.name, person.gender, person.birthday, person.role FROM person
            JOIN film_actor ON film_actor.actorID = person.personID
            JOIN film ON film.filmID = film_actor.filmID 
            WHERE film.filmID = :filmID AND person.role = 'actor'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":filmID" => $film->getFilmID()]);
        $actors = [];
        while ($row1 = $stmt->fetchObject()) {
            $actor = new Person($row1);
            $actors[] = $actor;
        }
        return $actors;
    }

    public function getDirectorbyFilm(Film $film) {
        $pdo = MyPDO::getInstance();
        $sql = "SELECT person.personID, person.name, person.gender, person.birthday, person.role FROM person 
                JOIN film ON film.directorID = person.personID
                WHERE film.filmID = :filmID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':filmID' => $film->getFilmID()]);
        $row = $stmt->fetchObject();
        $director = new Person($row);
        return $director;
    }

    public function insert(Person $person)
    {
        $pdo = MyPDO::getInstance();
        $query = 'INSERT INTO person (name, gender, birthday, role) VALUES (:name, :gender, :birthday, :role) ';
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':name'=>$person->getName(),
            ':gender'=> $person->getGender(),
            ':birthday'=>$person->getBirthday(),
            ':role'=>$person->getRole()
        ]);
    }

    public function update(Person $person)
    {
        $pdo = MyPDO::getInstance();
        $query = 'UPDATE person SET name = :name, gender = :gender, birthday = :birthday, role = :role WHERE personID = :personID';
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':name'=>$person->getName(),
            ':gender'=> $person->getGender(),
            ':birthday'=>$person->getBirthday(),
            ':role'=>$person->getRole(),
            ':personID' => $person->getPersonID()
        ]);
    }

    public function delete(Person $person)
    {
        $pdo = MyPDO::getInstance();
        $query = 'DELETE FROM person WHERE personID = :personID';
        $stmt = $pdo->prepare($query);
        $stmt->execute([':personID'=>$person->getPersonID()]);
    }
}