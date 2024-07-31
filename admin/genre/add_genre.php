<?php
require_once "../../include/inc.php";
if (isset($_POST['submit']) && isset($_POST['genre'])) {
    $genre = new Genre();
    $genre->setName($_POST['genre']);
    $GenreRepo = new GenreRepository;
    $GenreRepo->insert($genre);
    header("location: ../../admin/list_movie.php?address=genre");
}

include '..\..\template\admin\genre\add_genre.phtml';