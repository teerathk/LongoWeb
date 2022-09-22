<?php

class location{
    
var $dbID; //Database value given by the database
var $name; // Name of the location


function getDBID(){
    return $this->dbID;
}

function setDBID($value){
    $this->dbID = $value;
}

function getName(){
    return $this->name;
}

function setName($value){
    $this->name = $value;
}
    





}

?>