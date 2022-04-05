<?php



spl_autoload_register(function($classname) {
    include "../classes/$classname.php";
});

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


$db = new Database();

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
           searches JSON,
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
           building text DEFAULT null,
           day1 text DEFAULT null,
           day2 text DEFAULT null,
           day3 text DEFAULT null,
           start text not null,
           end text not null
          );");

$resource = fopen("../dclean/uvabuildings.csv", 'r');
while (($building = fgetcsv($resource)) != FALSE) {
    if($building[1] == 'Web-Based Course-No class mtgs')
        continue;
//    $stmt = $db->prepare("INSERT INTO building (name) VALUES (?)");
//    $stmt->bind_param("s", $building[1]);
//    $stmt->execute();
    $db->query("INSERT INTO building (name) VALUES (?)","s", $building[1] );
}


function formatDate($date): array
{
    $data = [];
    $days = ["date1", "date2", "date3"];
    $iter = 0;
    $arr = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
    foreach($arr as $k){
        $pos = strpos($date, $k);
        //echo $pos . " " . $k;
        if($pos !== FALSE){
            $data[$days[$iter]] = $k;
            $iter++;
        }
    }
    foreach($days as $k){
        if(!isset($data[$k])){
            $data[$k] = null;
        }
    }
    $str = explode(" ", $date);
    $data["end"] = $str[3];
    $data["start"] = $str[1];

    return $data;
}


//Array ( [0] => 1 [1] => AAS [2] => 1020 [3] => 100 [4] => Lecture [5] => Ashon Crawley [6] => TuTh 12:30pm - 1:45pm [7] => Wilson Hall 301 [8] => Wilson Hall )
$resource = fopen("../data/dclean.csv", 'r');
while (($classroom = fgetcsv($resource)) != FALSE) {
    if($classroom[7] == 'Web-Based Course-No class mtgs')
        continue;
//    print_r($classroom);
    $date = formatDate($classroom[6]);
//    echo "<pre>";
//    print_r($date);
//   echo "</pre>"; 
    $db->query("INSERT INTO classroom (number,section, mnemonic,
                       instructor, room, building, day1, day2, day3, start, end)
                       VALUES (?,?,?,?,?,?,?,?,?,?,?)",
        "iisssssssss",
        $classroom[2], $classroom[3], $classroom[1], $classroom[5],
        $classroom[7], $classroom[8], $date["date1"], $date["date2"], $date["date3"],
        $date["start"], $date["end"]);
}
