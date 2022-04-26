<?php

/*
 * Referenced as:
 * $buildings = new Buildings();
 * Global Object that is initialized once
 */

class Buildings
{

    public static Database $db;
    public static int $numClasses;
    public static array $classList;

    public function __construct(){
        self::$classList = [];
        self::$numClasses = 0;
        self::$db = new Database();
    }

    public static function buildRoom($name){
        if(!isset(self::$classList[$name])){
            self::$classList[$name] = new Classroom($name);
        }
       self::$numClasses++;
    }
}