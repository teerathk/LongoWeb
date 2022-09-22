<?php

class employee{
    
var $dbID; //   Database value given by the database
var $firstName;
var $lastName;
var $userName; // This is the id that an employee will use to identify themselves when scanning QR code
var $password; //   This is the password that an employee will enter when they scan QR code
var $emailAddress;
var $role;
var $lastUpdated; //    Timestamp set by the database


function needPassword(){
	
	//	Check to see if this is a new user based off of password
	if (stristr(strtolower($this->password), '3A3') || $this->password == "abc123") {
		return TRUE;
		
	}
	else{
		return FALSE;
		
	}

}


function getDBID(){
    return $this->dbID;
}

function setDBID($value){
    $this->dbID = $value;
}

function getFirstName(){
    return $this->firstName;
}

function setFirstName($value){
    $this->firstName = $value;
}
    
function getLastName(){
    return $this->lastName;
}

function setLastName($value){
    $this->lastName = $value;
}

function getFullName(){
    return $this->firstName . " " . $this->lastName;
}

function getUserName(){
    return $this->userName;
}

function setUserName($value){
    $this->userName = $value;
}

function getPassword(){
    return $this->password;
}

function setPassword($value){
    $this->password = $value;
}

function getEmailAddress(){
    return $this->emailAddress;
}

function setEmailAddress($value){
    $this->emailAddress = $value;
}

function getRole(){
    return $this->role;
}

function setRole($value){
    $this->role = $value;
}

function getLastUpdated(){
    return $this->lastUpdated;
}

function setLastUpdated($value){
    $this->lastUpdated = $value;
}





}

?>