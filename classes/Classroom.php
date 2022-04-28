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
            //check if class is held multiple days, separate times held into their respective days
            foreach ($this->days as $day) {
                if (isset($classroom[$day])) {
                    $this->classListTimes[$classroom["room"]][$classroom[$day]][] = $classInfo;
                }
            }
        }
            //sort the times held in order
            $dayName = ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];
            //foreach classroom in building
            foreach($this->classListTimes as $className => $classDay){
//                echo "<pre>";
//                print_r($className);
//                print_r($dayKey);
//                echo "<h2> break </h2>";
//                print_r($timeList);
//                echo "</pre>";
                //foreach day that the classroom is held
                    foreach($dayName as $dayHeld){
//                        echo "<h1>" . $dayHeld . "</h1>";
                        //sort the classroom objects stored in by start classtime
                        if(isset($classDay[$dayHeld])){
                            $sorted = $classDay[$dayHeld];
                            $sorted = $this->merge_sort($sorted);
                            $this->classListTimes[$className][$dayHeld] = $sorted;
                        }
                    }
            }
            //sort the sames of the classrooms
            ksort($this->classListTimes, SORT_NATURAL);
    }

    //credit to https://www.w3resource.com/php-exercises/searching-and-sorting-algorithm/searching-and-sorting-algorithm-exercise-17.php
    //edited to fit my data
    function merge_sort($my_array){
        if(count($my_array) == 1 ) return $my_array;
        $mid = count($my_array) / 2;
        $left = array_slice($my_array, 0, $mid);
        $right = array_slice($my_array, $mid);
        $left = $this->merge_sort($left);
        $right = $this->merge_sort($right);
        return $this->merge($left, $right);
    }

    function merge($left, $right): array
    {
        $res = array();
        while (count($left) > 0 && count($right) > 0){
            if($left[0]["start"] > $right[0]["start"]){
                $res[] = $right[0];
                $right = array_slice($right , 1);
            }else{
                $res[] = $left[0];
                $left = array_slice($left, 1);
            }
        }
        while (count($left) > 0){
            $res[] = $left[0];
            $left = array_slice($left, 1);
        }
        while (count($right) > 0){
            $res[] = $right[0];
            $right = array_slice($right, 1);
        }
        return $res;
    }
}