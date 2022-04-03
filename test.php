<?php

$resource = fopen("dclean/uvabuildings.csv", 'r');
while (($building = fgetcsv($resource)) != FALSE) {
    print_r($building[1]);
}