<?php

//  Set user properties to session
function userToSession(employee $theEmployee){
    $_SESSION['employeeName'] = $theEmployee->getFullName();
    $_SESSION['userName'] = $theEmployee->getUserName();
    $_SESSION['userEmial'] = $theEmployee->getEmailAddress();
    $_SESSION['userRole'] = $theEmployee->getRole();
    $_SESSION['userId'] = $theEmployee->getDBID();
}

function addSessionErrorMessage($errorMessage){
    if(!isset($_SESSION['errorMessages'])){
       $_SESSION['errorMessages'] = array();
    }
     $_SESSION['errorMessages'][count($_SESSION['errorMessages'])] = $errorMessage;
}

function getSessionErrorMessages(){
    if(isset($_SESSION['errorMessages'])){
        $errorMessages = $_SESSION['errorMessages'];
        unset($_SESSION['errorMessages']);
        return $errorMessages;
    }
    else{
        return NULL;
    }
    
}

function getContext(){
    if(isset($_SESSION['userContext'])){
        return $_SESSION['userContext'];
    }
    else{
        return NULL;
    }
}


?>
