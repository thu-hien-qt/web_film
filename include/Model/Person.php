<?php

class Person {
    private $personID;
    private $name;
    private $gender;
    private $birthday;
    private $role;

    

    public function getPersonID()
    {
        return $this->personID;
    }

    public function setPersonID($personID)
    {
        $this->personID = $personID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
}