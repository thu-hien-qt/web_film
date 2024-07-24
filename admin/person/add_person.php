<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id == 2 && isset($_POST['Psubmit']) && isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['birthday']) && isset($_POST['role'])) {
        $person = new Person();
        $person->setName($_POST['name']);
        $person->setGender($_POST['gender']);
        $person->setBirthday($_POST['birthday']);
        $person->setRole($_POST['role']);
        $personRepo = new PersonRepository;
        $personRepo->insert($person);
        $id = $_GET['id'];
        header("location: ../admin/list_movie.php?id=$id");
    }
}

require_once '..phim\template\admin\people\add_person.phtml';