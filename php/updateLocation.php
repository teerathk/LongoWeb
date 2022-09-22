<?php

// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])|| $_SESSION['userRole']!='admin') {
header('Location: index.php');
}
include_once 'globals.php';
if(isset($_GET['delid'])){
    $dbLocation = new locationDB();
    $dbLocation->deleteLocation($_GET['delid']);
    header ('Location: ../admin/manageLocations.php');  
    
}
else{

$currentLocationId = trim($_POST['currentLocationID']);
$_SESSION['updateLocation']['currentLocationId'] = $currentLocationId;
$locationNumber = trim($_POST['locationNumber']);
$_SESSION['updateLocation']['locationNumber'] = $locationNumber;
$locationName = trim($_POST['locationName']);
$_SESSION['updateLocation']['locationName'] = $locationName;
$theLocation = new location();
$theLocation->setDBID($locationNumber);
$theLocation->setName($locationName);



$dbLocation = new locationDB();

if($locationNumber==''){
    $_SESSION['updateLocation']['errors']['locationNumber'] = 'Please enter the location number';
}
$locationAvailable = $dbLocation->locationAvailable($locationNumber);

if($locationAvailable==FALSE){
    if($currentLocationId!=$locationNumber){
        $_SESSION['updateLocation']['errors']['locationNumber'] = 'This location number is already being used';
    }
}

if($locationName==''){
     $_SESSION['updateLocation']['errors']['locationName'] = 'Please enter the location name.';
}



if(isset($_SESSION['updateLocation']['errors']) && count($_SESSION['updateLocation']['errors'])>0){
    header ('Location: ../admin/updateLocation.php?updateFailed');
}
else{
    if($currentLocationId=='new'){
        $dbLocation->addNewLocation($theLocation);
    }
    else{
        $dbLocation->updateLocation($theLocation, $currentLocationId);
    }
     
    unset($_SESSION['updateLocation']);

    header ('Location: ../admin/manageLocations.php');   
}  

}
?>
