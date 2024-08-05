<?php
namespace App;
require_once "pdo.php";

spl_autoload_register(function ($className) {
    $base_dir = realpath(dirname(__FILE__));
    $filepath = $base_dir.str_replace("App","",$className);
    $filepath = str_replace(["App","\""], DIRECTORY_SEPARATOR, $filepath ).".php";
    /* todo : find the file path from the class name :
    - if classname doesn't contains "App\" => return
    - remove "App\"
    - replace "\" with DIRECTORY_SEPARATOR
    - add ".php"
    */

    if (file_exists($filepath)) {
        require_once "$filepath";
    } else {
        echo "File is not found";
    }
});

//foreach (glob(__DIR__."/Model/*.php") as $file) {
//    require_once $file;
//}
//
//$repos = glob(__DIR__."/Repository/*.php");
//foreach ($repos as $file) {
//    require_once $file;
//}
//
//foreach (glob(__DIR__."/Controller/*.php") as $file) {
//    require_once $file;
//}
//
//foreach (glob(__DIR__."/Controller/Admin/*.php") as $file) {
//    require_once $file;
//}
//
//foreach (glob(__DIR__."/Controller/Front/*.php") as $file) {
//    require_once $file;
//}
//
//foreach (glob(__DIR__."/Kernel/*.php") as $file) {
//    require_once $file;
//}
