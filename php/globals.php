<?php
//  This file needs to be included on the main page being called (eg index.php)

define('APP', true);
error_reporting(E_ALL ^ E_DEPRECATED);

//  include parent class files
include 'template.php';
include 'dbConnect.php';
include 'employeeDB.php';
include 'jobDB.php';
include 'locationDB.php';
include 'searchBox.php';

//  include functions
include 'dbConnection.php';
include 'functions/dates.php';
include 'functions/numbers.php';
include 'functions/formValidation.php';
include 'functions/strings.php';
include 'functions/session.php';
include 'logLogin.php';




//  Time zone
$GLOBALS['timeZone'] = 'America/Chicago';
$GLOBALS['maxJobTime'] = 24;
//$GLOBALS['maxJobTime'] = 12;

$GLOBALS['errorMessages'] = array();



?>
