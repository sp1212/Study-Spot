<?php



spl_autoload_register(function($classname) {
    include "../classes/$classname.php";
});

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db = new mysqli(Config::$db["host"], Config::$db["user"], Config::$db["pass"], Config::$db["database"]);

$db->query("drop table if exists secretspot;");

//$db->query(
//    "create table secretspot (
//            --TODO
//          );");

//$db->query(
//    "create table user (
//           /*TODO*/
//          );");

$db->query("drop table if exists building;");
$db->query(
    "create table building (
           id int not null auto_increment,
           name text not null,
           PRIMARY KEY (id)
          );");

//$db->query(
//    "create table classroom (
//           /*TODO*/
//          );");
$resource = fopen("../dclean/uvabuildings.csv", 'r');
while (($building = fgetcsv($resource)) != FALSE) {
    if($building[1] == 'Web-Based Course-No class mtgs')
        continue;
    $stmt = $db->prepare("INSERT INTO building (name) VALUES (?)");
    $stmt->bind_param("s", $building[1]);
    $stmt->execute();
}