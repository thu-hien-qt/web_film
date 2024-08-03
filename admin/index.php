<?php 
require_once "../include/inc.php";
session_start();

$kernel = new \Kernel\Kernel();
$kernel->run('admin');

?>
