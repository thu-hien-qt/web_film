<?php

require_once "pdo.php";

foreach (glob("./Model/*.php") as $file) {
    require_once $file;
}

foreach (glob("./Repository/*.php") as $file) {
    require_once $file;
}