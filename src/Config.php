<?php
namespace App;
use \PDO;

class Config {
    
    public static function getPDO (): PDO {
        //Connection à la bdd
        return new PDO('mysql:host=localhost;dbname=kgb;', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}