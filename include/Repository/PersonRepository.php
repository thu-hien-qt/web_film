<?php

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

    public function getActor()
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

    public function getDirector()
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
            throw new Exception("Person $personID not found");
        }

        $person = new Person($row);
        return $person;
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
        $query = 'UPDATE person SET name = :name, gender = :gender, birthday = :birthday, role = :role';
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':name'=>$person->getName(),
            ':gender'=> $person->getGender(),
            ':birthday'=>$person->getBirthday(),
            ':role'=>$person->getRole()
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