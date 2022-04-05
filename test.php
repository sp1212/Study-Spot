<?php

//$resource = fopen("dclean/uvabuildings.csv", 'r');
//while (($building = fgetcsv($resource)) != FALSE) {
//    print_r($building[1]);
//}

$date1 = "Tu 6:00pm - 6:50pm";
$date2 = "MoWe 2:00pm - 3:15pm";
$date3 = "MoWeFr 10:00am - 10:50am";

$temp = new DateTime("6:00pm");
echo $temp->format("Ga");

// https://www.php.net/manual/en/datetime.format.php

//function formatTime($time): string
//{
//    $pm = strpos($time, "pm");
//    $time = trim($time, "pam");
//    echo $time;
//    $date = new DateTime($time);
//    if($pm !== FALSE){
//        $temp = 0;
//    }
//    return "hi";
//}


//function formatDate($date): array
//{
//    $data = [];
//    $days = ["date1", "date2", "date3"];
//    $iter = 0;
//    $arr = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
//    foreach($arr as $k){
//        $pos = strpos($date, $k);
//        //echo $pos . " " . $k;
//        if($pos !== FALSE){
//            $data[$days[$iter]] = $k;
//            $iter++;
//        }
//    }
//    print_r($data);
//    foreach($days as $k){
//        if(!isset($data[$k])){
//            $data[$k] = null;
//        }
//    }
//    $str = explode(" ", $date);
//    $data["end"] = $str[3];
//    $data["start"] = $str[1];
//
//    return $data;
//}
$temp = formatDate($date2);
print_r($temp["date3"]);
print_r($temp);