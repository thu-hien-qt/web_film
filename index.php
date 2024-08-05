<?php
require_once "include/inc.php";

use App\Kernel\Kernel;
session_start();

$kernel = new Kernel;
$kernel->run('front');

