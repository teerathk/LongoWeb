<?php

// Inialize session
if($_COOKIE['ses_id']){
    session_id($_COOKIE['ses_id']);
}
session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])|| $_SESSION['userRole']!='admin') {
header('Location: index.php');
}

require '../php/globals.php';
$dbEmployee = new employeeDB();


if(isset($_GET['delid'])){
    $dbEmployee->deleteEmployee($_GET['delid']);
    header('Location: manageUsers.php');
}

$dbid = "";
$firstName="";
$lastName = "";
$userName = "";
$email = "";
$role = "";
$currentUserName = 'new_user';
if(isset($_GET['userId'])&& $_GET['userId']=='new'){
    //  we are going to add a new employee
    $formMode = 'new';
    $pageTitle = 'Add New User';
    $submitButton = 'Add User';
}
elseif(isset($_SESSION['errors'])){
    $formMode = $_SESSION['uform']['u_formMode'];
    $dbid = $_SESSION['uform']['u_dbid'];
    $firstName = $_SESSION['uform']['u_firstName'];
    $lastName = $_SESSION['uform']['u_lastName'];
    $userName = $_SESSION['uform']['u_userName'];
    $currentUserName = $_SESSION['uform']['u_currentUserName'];
    $email = $_SESSION['uform']['u_email'];
    $role = $_SESSION['uform']['u_role'];
    $pageTitle = $_SESSION['uform']['u_pageTitle'];
    if($formMode=='new'){
        $submitButton = 'Add User';
    }
    elseif($formMode=='edit'){
        $submitButton = 'Update User';
    }
}
elseif(isset($_GET['userId'])){
    //  we are editing an existing employee
    $formMode = 'edit';
    $submitButton = 'Update User';
    $theEmployee = new employee() ;
    $theEmployee = $dbEmployee->getSingleEmployee($_GET['userId']);
    $dbid = $theEmployee->getDBID();
    $firstName = $theEmployee->getFirstName();
    $lastName = $theEmployee->getLastName();
    $userName = $theEmployee->getUserName();
    $currentUserName = $userName;
    $email = $theEmployee->getEmailAddress();
    $role = $theEmployee->getRole();
    $pageTitle = "Update User";
}
else{
    header('Location: manageUsers.php');
}




$title = 'Longo Corporation - Update Employee';
$description = '';
$keywords = '';

printHeadAdmin($title, $description, $keywords);
printHeaderAdmin();
?>

<!--==============================content================================-->


<section id="content">

    <div class="container_12">

    </div>
    <div class="aside">
        <div class="container_12">	

                <h3>
                    <?php print $pageTitle ?>
                </h3>
                <br />
                
                
    <form id="updateEmployee" action="../php/updateEmployee.php" name="updateEmployee" method="POST">
        <input type="hidden" value="<?php print $dbid;?>" name="dbid">
        <input type="hidden" value="<?php print $formMode?>" name="formMode">
        <input type="hidden" value="<?php print $pageTitle?>" name="pageTitle">
        <input type="hidden" value="<?php print $currentUserName?>" name="currentUserName">
        
        
        
        <?php 
            if(isset($_SESSION['errors']['firstName'])){
                print '<p class="errors">' . $_SESSION['errors']['firstName'] . '</p>';
            }
        ?>
        
        <label style="width: 100px;display: inline-block">
            First Name:
        </label>
        <input type="text" style="width: 200px;display: inline-block" value="<?php print $firstName;?>" name="firstName">
        <br />
        
        <?php 
            if(isset($_SESSION['errors']['lastName'])){
                print '<p class="errors">' . $_SESSION['errors']['lastName'] . '</p>';
            }
        ?>        
         <label style="width: 100px;display: inline-block">
            Last Name:
        </label>
        <input type="text" style="width: 200px;display: inline-block" value="<?php print $lastName;?>" name="lastName">
        <br /> 
        
        <?php 
            if(isset($_SESSION['errors']['userName'])){
                print '<p class="errors">' . $_SESSION['errors']['userName'] . '</p>';
            }
        ?>        
       <label style="width: 100px;display: inline-block">
            User Name:
        </label>
        <input type="text" style="width: 200px;display: inline-block" value="<?php print $userName;?>" name="userName">
        <br />
        
        <?php 
            if(isset($_SESSION['errors']['email'])){
                print '<p class="errors">' . $_SESSION['errors']['email'] . '</p>';
            }
        ?>
        
         <label style="width: 100px;display: inline-block">
            Email Address:
        </label>
        <input type="text" style="width: 200px;display: inline-block" value="<?php print $email;?>" name="email">
        <br /> 
        
        <?php 
            if(isset($_SESSION['errors']['role'])){
                print '<p class="errors">' . $_SESSION['errors']['role'] . '</p>';
            }
        ?>
        
        <label style="width: 100px;display: inline-block">
            User Role:
        </label>
        <select name="role">
            <option value=""<?php if($role==""){print 'selected="selected"';} ?>></option>
            <option value="employee"<?php if($role=="employee"){print 'selected="selected"';} ?>>Employee</option>
            <option value="admin"<?php if($role=="admin"){print 'selected="selected"';} ?>>Administrator</option>
        </select>
 <div class="btns">
 	<input type="submit" value="<?php print $submitButton?>" class="button">
                    
                    <a class="button" href="manageUsers.php"> Cancel</a>
                    <?php
                        if($formMode=='edit'){
                           
                              if($_SESSION['userName']==$userName){ ?>
                              	
                                  <a class="button" href="changePassword.php">Update My Password</a>
                                  <?php
                                  $_SESSION['updatePassword'] = TRUE;
                              }
						} 
                    ?>
                    
                    
                    
                </div>        
    </form>
               
                
                <div class="clear"></div>
            </div>
        </div>  
    </section> 

    <?php 
    if(isset($_SESSION['errors'])){
        unset($_SESSION['errors']);
    }
    if (isset($_SESSION['uform'])) {
        unset($_SESSION['uform']);
}
    printFooter();?>