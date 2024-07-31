<?php

class MyPDO extends PDO {

    static function getInstance()
    {
        static $pdo;
        if (!isset($pdo)) {
            $pdo = new PDO('mysql:host=localhost;dbname=movie', 'root', '');
        }

        return $pdo;
    }
}

$pdo = MyPDO::getInstance();
