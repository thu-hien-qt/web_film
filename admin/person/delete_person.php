<?php
if (isset($_POST["rep"])) {
    if (isset($_GET["personID"]) && $_POST["rep"] == 1) {

        $PersonRepo = new PersonRepository;
        $person = $PersonRepo->getPersonById($_GET['personID']);
        $name = $person->getName();
        $PersonRepo->delete($person);
        header("location:..\admin\list_movie.php?id=2 && yes=$name");
        exit;
    } else {
        header("location:..\admin\list_movie.php?id=2 && error=2");
        exit;
    }
}

require_once '..\template\admin\people\delete_person.phtml';