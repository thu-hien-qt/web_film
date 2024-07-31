<?php
require_once "../../include/inc.php";

if (
    isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['gender'])
    && isset($_POST['birthday']) && isset($_POST['role'])
) {
    $person = new Person();
    $person->setName($_POST['name']);
    $person->setGender($_POST['gender']);
    $person->setBirthday($_POST['birthday']);
    $person->setRole($_POST['role']);
    $personRepo = new PersonRepository;
    $personRepo->insert($person);
    header("location: ../../admin/list_movie.php?address=person");
}


require_once '..\..\template\admin\people\add_person.phtml';
