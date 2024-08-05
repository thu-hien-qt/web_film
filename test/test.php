<?php

use App\Kernel\Kernel;
use App\Kernel\Router;
use App\Model\Film;

require_once "../include/inc.php";

$film = new Film();
$router = new Router();
$kernel = new Kernel();