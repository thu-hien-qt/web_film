<?php

require_once "pdo.php";

foreach (glob("../include/Model/*.php") as $file) {
    require_once $file;
}

$repos = glob("../include/Repository/*.php");
foreach ($repos as $file) {
    require_once $file;
}

// require_once " ../include/Repository/GenreRepository.php";