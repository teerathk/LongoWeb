<?php

session_start();
require_once 'globals.php';

$userId = $_POST['dbid'];
$dbEmployee = new employeeDB();
$theEmployee = new employee() ;
    $theEmployee = $dbEmployee->getSingleEmployee($userId);
    $dbid = $theEmployee->getDBID();
    $_SESSION['newUser']['fullName'] = $theEmployee->getFirstName() . " " . $theEmployee->getLastName();

    $_SESSION['newUser']['userName'] = $theEmployee->getUserName();

    $_SESSION['newUser']['email'] = $theEmployee->getEmailAddress();
	$_SESSION['newUser']['password'] = $theEmployee->getPassword();
	include 'emailMessages/newUser.php';
	
	$_SESSION['PasswordResent'] = 'Password has been resent to ' . $_SESSION['newUser']['fullName'] . ' at ' . $_SESSION['newUser']['email'] . '.';
	unset($_SESSION['newUser']);
	header('Location: ../admin/manageUsers.php');



?>