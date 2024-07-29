<?php
require_once "../../include/inc.php";
if (isset($_GET["genreID"])) {

    if (isset($_POST["submit"])) {
        $GenreRepo = new GenreRepository;
        $genre = $GenreRepo->getById($_GET["genreID"]);
        $genreName = $genre->getName();
        if ($_POST["submit"] == 1) {
            $GenreRepo->delete($genre);
            header("location:..\..\admin\list_movie.php?address=genre&&yes=$genreName");
            exit;
        } elseif ($_POST["submit"] == 0) {
            header("location:..\..\admin\list_movie.php?address=genre&&err=$genreName");
            exit;
        }
    }
} else {
    header("location:..\..\admin\list_movie.php?address=genre");
    exit;
}

require_once '..\..\template\admin\genre\delete_genre.phtml';
