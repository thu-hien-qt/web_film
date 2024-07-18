<?php
require_once "../include/inc.php";
if (isset($_POST["rep"])) {
    if (isset($_GET["genreID"]) && $_POST["rep"] == 1) {

        $GenreRepo = new GenreRepository;
        $genre = $GenreRepo->getById($_GET["genreID"]);
        $genreName = $genre->getName();
        $GenreRepo->delete($genre);
        header("location:..\admin\list_movie.php?id=1 && yes=$genreName");
        exit;
    } else {
        header("location:..\admin\list_movie.php?id=1 && error=1");
        exit;
    }

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


    if (isset($_GET["userID"]) && $_POST["rep"] == 1) {

        $UserRepo = new UserReposiroty;
        $user = $UserRepo->getUserByID($_GET['userID']);
        $userName = $user->getName();
        $UserRepo->delete($user);
        header("location:..\admin\list_movie.php?id=3 && yes=$userName");
        exit;
    } else {
        header("location:..\admin\list_movie.php?id=3 && error=3");
        exit;
    }
}


?>
<form method="post">
    <p>If you want to delete</p>
    <button type="submit" name="rep" value="0">No</button>
    <button type="submit" name="rep" value="1">yes</button>
</form>