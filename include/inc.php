<?php

require_once "pdo.php";

foreach (glob(__DIR__."/Model/*.php") as $file) {
    require_once $file;
}

$repos = glob(__DIR__."/Repository/*.php");
foreach ($repos as $file) {
    require_once $file;
}

// require_once " ../include/Repository/GenreRepository.php";