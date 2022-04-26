<?php

class Classroom
{
    public $className; //TODO: need to add class names to database, fuck
    public $classListTimes;
    public DateTimeZone $timezone;

    public function __construct($name){
        $data = Buildings::$db->query("SELECT * FROM classroom WHERE building = ?;", "s", $name);
        $this->timezone = new DateTimeZone($_SESSION['timezone']); //look for where this session variable is defined, make it a datetimezone

        foreach ($data as $classroom) {
            $timeHeld = array(new DateTime($classroom["start"], $this->timezone), new DateTime($classroom["end"], $this->timezone));
            $this->classListTimes[$classroom["room"]][] = $timeHeld;
//            echo "<h1>pushing new: " . $classroom["room"] . "!</h1>";

        }
    }
}