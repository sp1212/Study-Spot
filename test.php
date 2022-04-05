<?php

//$resource = fopen("dclean/uvabuildings.csv", 'r');
//while (($building = fgetcsv($resource)) != FALSE) {
//    print_r($building[1]);
//}

$date1 = "Tu 6:00pm - 6:50pm";
$date2 = "MoWe 2:00pm - 3:15pm";
$date3 = "MoWeFr 10:00am - 10:50am";

function formatDate($date): array
{
    $data = [];
    $days = ["date1", "date2", "date3"];
    $iter = 0;
    $arr = ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"];
    foreach($arr as $k){
        $pos = strpos($date, $k);
        echo $pos . " " . $k;
        if($pos !== FALSE){
            $data[$days[$iter]] = $k;
            $iter++;
        }
    }
    
    $str = explode(" ", $date);
    $data["end"] = $str[3];
    $data["start"] = $str[1];
    
    return $data;
}
print_r(formatDate($date2));