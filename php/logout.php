<?php

// Inialize session
session_start();
$cookieLifetime = 16 * 60 * 60; // A year in seconds
setcookie("ses_id","",time()-$cookieLifetime); //set lifetime to negative to autodelete cookie


// Delete certain session
unset($_SESSION['employeeId']);
unset($_SESSION['employeeFirstName']);
unset($_SESSION['employeeLastName']);
unset($_SESSION['userName']);

$userContext = $_SESSION['userContext'];
if(isset($_GET['context'])){
    $userContext = $_GET['context'];
}

if($userContext=='log'){
    header('Location: ../log/index.php');
}
else if($userContext=='admin'){
    header('Location: ../admin/index.php');
}
//  Delete all session variables
session_destroy();

// Jump to login page

?>
