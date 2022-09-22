<?php
// Inialize session
if($_COOKIE['ses_id']){
    session_id($_COOKIE['ses_id']);
}
session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])) {
header('Location: index.php');
}


require '../php/globals.php';

$dbUsers = new employeeDB();

$allUsers = new employees();
$allUsers = $dbUsers->getAllEmployees();


$title = 'Longo Corporation - Manage Users';
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
            <div class="grid_12">
                <h3>
                    Manage Users
                </h3>
                
<?php

if(isset($_SESSION['PasswordResent'])){
	
	print '<h4 style="color:red;text-align:center;">' .  $_SESSION['PasswordResent'] . '</h4>';
	unset($_SESSION['PasswordResent']);
}
elseif(isset($_SESSION['PasswordReset'])){
	// display $_SESSION['PasswordReset']
}

?>


                <br />
                
                <a class="button" href="updateUser.php?userId=new"> Add New User </a>
                <br />
                <br />
              <?php
                $allUsers->printEmployeeList();
              ?>

                
                
           </div>
            <div class="clear"></div>
        </div>
    </div>  
</section> 

<?php printFooter();?>