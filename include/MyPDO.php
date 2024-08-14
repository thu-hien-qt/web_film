<?php
namespace App;
class MyPDO extends \PDO {

    private static $pdo = null;
    private function __construct($dsn, $username = null, $password = null, $options = null)
    {   
        parent::__construct($dsn, $username, $password, $options);
    }
    static function getInstance()
    {
        if (!isset(static::$pdo)) {
            static::$pdo = new self('mysql:host=localhost;dbname=movie', 'root', '');
        }
        return static::$pdo;
    }
}
