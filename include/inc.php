<?php
namespace App;

// spl_autoload_register(function ($className) {
//     $base_dir = realpath(dirname(__FILE__));
//     $filepath = $base_dir.str_replace("App","",$className);
//     $filepath = str_replace("\\", DIRECTORY_SEPARATOR, $filepath ).".php";
//     if (file_exists($filepath)) {
//         require_once "$filepath";
//     } else {
//         echo "File is not found";
//     }
// });
include __DIR__.'/../vendor/autoload.php';
