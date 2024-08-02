<?php

require_once "pdo.php";

foreach (glob(__DIR__."/Model/*.php") as $file) {
    require_once $file;
}

$repos = glob(__DIR__."/Repository/*.php");
foreach ($repos as $file) {
    require_once $file;
}

foreach (glob(__DIR__."/Controller/*.php") as $file) {
    require_once $file;
}

foreach (glob(__DIR__."/Controller/Admin/*.php") as $file) {
    require_once $file;
}

foreach (glob(__DIR__."/Controller/Front/*.php") as $file) {
    require_once $file;
}

foreach (glob(__DIR__."/Kernel/*.php") as $file) {
    require_once $file;
}
