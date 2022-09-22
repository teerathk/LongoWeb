<?php

function getLocationOptions(){
    $dbLocations = new locationDB();
    $allLocations = new locations();
    $allLocations = $dbLocations->getAllLocations();
    foreach ($allLocations as $theLocation){
        print '<option value="' . $theLocation->getDBID() . '">' . $theLocation->getLocationName() . '</option>';
    }
    
}

function getEmpoloyeeOptions(){
    
}

function getSortOptioins(){
    
}

function getDateRangeOptions(){
    
}
?>
