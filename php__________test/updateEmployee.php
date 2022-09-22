<?php
// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])||$_SESSION['userRole']!='admin') {
header('Location: ../admin/index.php');
}

//  Check to see if form is in POST
if(!isset($_POST['dbid'])){
    
    header('Location: ../admin/manageUsers.php');
}

require_once 'globals.php';
$dbEmployee = new employeeDB();
$errors = array();
$uform = array();

$dbid = trim(($_POST['dbid']));
$uform['u_dbid'] = $dbid;

$lastName = trim(($_POST['lastName']));
$uform['u_lastName'] = $lastName;

$firstName = trim(($_POST['firstName']));
$uform['u_firstName'] = $firstName;

$userName = trim(($_POST['userName']));
$uform['u_userName'] = $userName;

$email = trim(($_POST['email']));
$uform['u_email'] = $email;

$role = ($_POST['role']);
$uform['u_role'] = $role;

$formMode = $_POST['formMode'];
$uform['u_formMode'] = $formMode;

$pageTitle = $_POST['pageTitle'];
$uform['u_pageTitle'] = $pageTitle;

$currentUserName = $_POST['currentUserName'];
$uform['u_currentUserName'] = $currentUserName;

if(is_null($firstName) || $firstName==''){
    $errors['firstName'] = 'Please enter the first name';
}

if(is_null($lastName) || $lastName == ''){
    $errors['lastName'] = 'Please enter the last name';
}

    $avail = $dbEmployee->userNameAvailable($userName);

if(is_null($userName) || $userName == ''){
    $errors['userName'] = 'Pleast enter a user name';
}
elseif($avail==FALSE){
    if($currentUserName!=$userName){
        $errors['userName'] = 'This user name is already taken';
    }
    
}

$emailAvail = $dbEmployee->checkEmailAvailable($email);

if(validateEmail($email)==FALSE){
    $errors['email'] = 'Pleast enter a valid email';
}

if($emailAvail==FALSE){
    //$errors['email'] = 'This email address is already being used';
}

if($role==""){
    $errors['role'] = 'Please select a user role';
}



if(count($errors)> 0){
    $_SESSION['errors'] = $errors;
    $_SESSION['uform'] = $uform;
    header('Location: ../admin/updateUser.php');
}
else{
    if(isset($_SESSION['errors'])){
        unset($_SESSION['errors']);
    }
    if(isset($_SESSION['uform'])){
        unset($_SESSION['uform']);
    }
    
    $theEmployee = new employee();
    $theEmployee->setDBID($dbid);
    $theEmployee->setFirstName($firstName);
    $theEmployee->setLastName($lastName);
    $theEmployee->setUserName($userName);
    $theEmployee->setEmailAddress($email);
    $theEmployee->setRole($role);
    
    if($formMode=='edit'){
        $dbEmployee->editEmployee($theEmployee);
    }
    elseif($formMode=='new'){
        $password = get_random_string("6");
        $password = "3A3" . "$password";
        $theEmployee->setPassword($password);
        $dbEmployee->addNewEmployee($theEmployee);
        $_SESSION['newUser']['fullName'] = $theEmployee->getFullName();
        $_SESSION['newUser']['userName'] = $theEmployee->getUserName();
        $_SESSION['newUser']['password'] = $theEmployee->getPassword();
        $_SESSION['newUser']['email'] = $theEmployee->getEmailAddress();
        include 'emailMessages/newUser.php';
    }
    
    header('Location: ../admin/manageUsers.php');
}




?>