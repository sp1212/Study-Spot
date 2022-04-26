<?php

class Classroom
{
    public $className; //TODO: need to add class names to database, fuck
    public $classListTimes;
    public DateTimeZone $timezone;
    public array $days;

    public function __construct($name)
    {
        $data = Buildings::$db->query("SELECT * FROM classroom WHERE building = ?;", "s", $name);
        $this->timezone = new DateTimeZone($_SESSION['timezone']); //look for where this session variable is defined, make it a datetimezone
        //a class can be held for a maximum of 3 days
        $this->days = ["day1", "day2", "day3"];
        $this->setClassroom($data);

//            echo "<h1>pushing new: " . $classroom["room"] . "!</h1>";

    }

    public function setClassroom($dbQuery)
    {
        foreach ($dbQuery as $classroom) {
            $classInfo = array("start" => new DateTime($classroom["start"], $this->timezone),
                                "end" => new DateTime($classroom["end"], $this->timezone),
                                "instructor" => $classroom["instructor"],
                                "number" => $classroom["number"],
                                "mnemonic" => $classroom["mnemonic"]
            );
            //check if class is held multiple days



            foreach ($this->days as $day) {
                if (isset($classroom[$day])) {
                    $this->classListTimes[$classroom["room"]][$classroom[$day]][] = $classInfo;
                }
            }
        }
    }
}