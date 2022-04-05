<?php



spl_autoload_register(function($classname) {
    include "../classes/$classname.php";
});

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db = new mysqli(Config::$db["host"], Config::$db["user"], Config::$db["pass"], Config::$db["database"]);

$db->query("drop table if exists secretspot;");

$db->query(
    "create table secretspot (
            id int not null auto_increment,
            user_id int not null,
            name text not null,
            votes int not null,
            PRIMARY KEY (id)
          );");

$db->query("drop table if exists user;");
$db->query(
    "create table user (
           id int not null auto_increment,
           name text not null,
           email text not null,
           password text not null,
           primary key (id)
          );");

$db->query("drop table if exists building;");
$db->query(
    "create table building (
           id int not null auto_increment,
           name text not null,
           PRIMARY KEY (id)
          );");

$db->query("drop table if exists classroom;");
$db->query(
    "create table classroom (
           number int not null,
           section int not null,
           mnemonic varchar(4) not null,
           instructor text not null,
           room text not null,
           building text not null,
           day1 datetime,
           day2 datetime,
           day3 datetime,
           start 
          );");

$resource = fopen("../dclean/uvabuildings.csv", 'r');
while (($building = fgetcsv($resource)) != FALSE) {
    if($building[1] == 'Web-Based Course-No class mtgs')
        continue;
    $stmt = $db->prepare("INSERT INTO building (name) VALUES (?)");
    $stmt->bind_param("s", $building[1]);
    $stmt->execute();
}


function formatDate($date){
    $days = [];


    return $days;
}




//Array ( [0] => 1 [1] => AAS [2] => 1020 [3] => 100 [4] => Lecture [5] => Ashon Crawley [6] => TuTh 12:30pm - 1:45pm [7] => Wilson Hall 301 [8] => Wilson Hall )
$resource = fopen("../data/dclean.csv", 'r');
while (($classroom = fgetcsv($resource)) != FALSE) {
    if($classroom[1] == 'Web-Based Course-No class mtgs')
        continue;
    print_r($classroom);
    $stmt = $db->prepare("INSERT INTO classroom (number,section, mnemonic,
                       instructor, room, building, day1, day2, day3) 
                       VALUES (?,?,?,?,?,?,?,?,?)");

}
