<?php
require '../php/globals.php';

if(isset($_POST['action'])){
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $dbid = $_POST['jobId'];
    $dbJobs = new jobDB();
    $theJobs = new jobs();
    $aJob = new job();
    $aJob->setDBID($dbJobs);
    
    if($_POST['action']=="New"){
        $dbJobs->updateStartCoordinates($dbid, $latitude, $longitude);
    }elseif($_POST['action']=="update"){
        $dbJobs->updateEndCoordinates($dbid, $latitude, $longitude);
    }

}

?>