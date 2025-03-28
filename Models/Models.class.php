<?php

abstract class Models{
    private static $pdo;

    private function setBd(){
        self::$pdo= new PDO("mysql:host=localhost;dbname=ltsa;charset=utf8","root","");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }
    protected function getBd(){
        if(self::$pdo===null){
            self::setBd();
        }
        return self::$pdo;
    }
}

?>