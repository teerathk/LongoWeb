<?php

//  Database connection 1
$host = "localhost";
$user = 'plegopro_longonew';
$password = 'LongoNew@123';
$database = 'plegopro_longonew';

$mysqli = new mysqli($host, $user, $password, $database);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

function connection() {
    $host = "localhost";
    $user = 'plegopro_longonew';
    $password = 'LongoNew@123';
    $database = 'plegopro_longonew';

    $mysqli = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }
    return $mysqli;
}
