<?php
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db = new mysqli(Config::$db["host"], Config::$db["user"], Config::$db["pass"], Config::$db["database"]);

$db->query("drop table if exists secretspot;");

$db->query(
    "create table secretspot (
            --TODO
          );");

$db->query(
    "create table user (
           --TODO 
          );");

$db->query(
    "create table building (
           --TODO
          );");

$db->query(
    "create table classroom (
           --TODO 
          );");