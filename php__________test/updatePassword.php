<?php

// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])) {
header('Location: index.php');
}

//  check to see if user was directed here from login.php
if(!isset($_SESSION['updatePassword'])){
    header('Location: index.php');
}


//  Clear Out previous values from previous attempts
if(isset($_SESSION['resetPassword'])){
    unset($_SESSION['resetPassword']);
}


include_once 'globals.php';

$userName = $_SESSION['userName'];
$currentPassword = $_POST['currentPassword'];
$_SESSION['resetPassword']['currentPassword'] = $currentPassword;
$newPassword = $_POST['newPassword'];
$_SESSION['resetPassword']['newPassword'] = $newPassword;
$confirmPassword = $_POST['confirmPassword'];
$_SESSION['resetPassword']['confirmPassword'] = $confirmPassword;

$userDB = new employeeDB();

$passwordVerified = $userDB->verifyPassword($userName, $currentPassword);


if($passwordVerified==FALSE || $currentPassword == '' || is_null($passwordVerified)){
    $_SESSION['resetPassword']['errors']['currentPassword'] = 'The current password entered is wrong. Please re-enter.';
	header ('Location: ../admin/changePassword.php?resetFailed');

}else{
$newPasswordLength = strlen ( $newPassword );
if($newPasswordLength < 6){
    $_SESSION['resetPassword']['errors']['newPassword'] = 'Please make the new password at least 6 characters long';

}

if($confirmPassword==''){
    $_SESSION['resetPassword']['errors']['confirmPassword'] = 'Please confirm new password';

}

if($confirmPassword!=$newPassword){
    $_SESSION['resetPassword']['errors']['confirmPassword'] = 'The new password does not match.';

}

if(isset($_SESSION['resetPassword']['errors']) && count($_SESSION['resetPassword']['errors'])>0){
    header ('Location: ../admin/changePassword.php?resetFailed');
}
else{

     $userDB->updatePassword($userName, $newPassword);
    unset($_SESSION['resetPassword']);
    $_SESSION['passwordReset'] = TRUE;
    header ('Location: ../admin/changePassword.php');   
 

}	
}





?>
