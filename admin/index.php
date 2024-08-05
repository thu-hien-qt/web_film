<?php
require_once "../include/inc.php";
session_start();

use App\Kernel\Kernel;


$kernel = new Kernel;
$kernel->run('admin');

?>
