<?php
/*
 * Sources:
 *
 */
session_start();

// Register the autoloader
//this tells apache where in our directory our classes are, this allows us to be more private
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});