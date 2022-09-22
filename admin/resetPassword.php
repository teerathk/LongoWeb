<?php

// Inialize session
if($_COOKIE['ses_id']){
    session_id($_COOKIE['ses_id']);
}
session_start();

// Include database connection settings
require ('../php/globals.php');
include_once ('../php/employeeDB.php');

$employeeDB = new employeeDB();
$anEmployee = $employeeDB->getEmployeeByEmail($_POST['email']);
$theEmployeeId = $anEmployee->getDBID();
if (isset($theEmployeeId)&& $theEmployeeId!=null) {
    if(isset($_SESSION['tmpEmail'])){
        unset($_SESSION['tmpEmail']);
    }
	
	$password = '3A3' . get_random_string("6");
	$employeeDB->updatePassword($anEmployee->getUserName(),$password);
	$_SESSION['passwordReset']['newPassword'] = $password;
	$_SESSION['passwordReset']['userName'] = $anEmployee->getUserName();
	$_SESSION['passwordReset']['fullName'] = $anEmployee->getFullName();
	$_SESSION['passwordReset']['email'] = $anEmployee->getEmailAddress();
	
	require '../php/emailMessages/passwordReset.php';
//  and send them an email with a new password

    // Jump to page showing that their password has been reset
    
    if(isset($_POST['directTo'])){
    	$_SESSION['PasswordResent'] = 'The Password for ' . $_SESSION['passwordReset']['fullName'] . ' has been reset. An email with a temporary password
    	has been sent to ' 	. $_SESSION['passwordReset']['email'] . '.';
		header('Location: manageUsers.php');
    }
else{
	header('Location: forgotPassword.php?passwordReset');
}
    
}
else {
    // Jump to login page
    $_SESSION['tmpEmailAddress'] = $_POST['emailAddress'];

    header('Location: forgotPassword.php?resetFailed');

}

?>
