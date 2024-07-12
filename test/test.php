<?php

include "include/inc.php";

$gerneRepo = new GenreRepository();

// show list
$list = $gerneRepo->getAll();
foreach ($list as $genre) {
    echo $genre->getName() . PHP_EOL;
}

print_r($list);

// add a genre
$genre = new Genre();
$genre->setName("new genre");
$gerneRepo->insert($genre);

//get by id
$genre = $gerneRepo->getById(1);
$genre->setName("new genre 1");
$gerneRepo->update($genre);
