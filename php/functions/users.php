<?php

//  Set user properties to session
function userToSession(employee $theEmployee){
    $_SESSION['employeeName'] = $theEmployee->getFullName();
    $_SESSION['userName'] = $theEmployee->getUserName();
    $_SESSION['userEmial'] = $theEmployee->getEmailAddress();
    $_SESSION['userRole'] = $theEmployee->getRole();
    $_SESSION['userId'] = $theEmployee->getDBID();
}


?>
