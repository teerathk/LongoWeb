<?php

// Inialize session
session_start();
$_SESSION['userContext'] = 'admin';
// Check, if user is already login, then jump to secured page
if (isset($_SESSION['userName'])) {
header('Location: manageJobs.php');
}
$userName = "";
$password = "";
if(isset($_GET["loginFailed"])){
	$tryAgain = TRUE;
        $userName = $_SESSION['tmpUserName'];
        $password = $_SESSION['tmpPassword'];
}
require '../php/globals.php';

$title = 'Longo Corporation - Time Log Access Login';
$description = 'This is the description';
$keywords = 'These are the keywords';

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
                    Time Log Access Login
                </h3>
                <br />
                <p>
                    Please enter your user name and password to log in.
                </p>
                <?php
                    //  Display Error Messages
                    $errors = getSessionErrorMessages();
                    if ($errors != NULL) {
                        print '<br /><p style="color:red;">';
                        for ($i=0; $i<=count($errors)-1; $i++){
                            print $errors[$i] . '<br />';
                        }
                        
}
                ?>
                <br />
 <form action="../php/login.php" method="post" name="loginForm" id="loginForm">
                        <fieldset>
                            <label>User Name</label>

                            <br />
                            <input type="text"  name="userName" value="<?php print $userName;?>" size="35" maxlength="20">
                                                        <?php 
                                if(isset($_SESSION['tmpUserName']) && $userName==""){
                                    print '<br /><span style="color:red">* Please Enter Your User Name</span>';
                                }
                            ?>
                            <br />
                            <label>Password</label>

                            <br />
                            <input type="password"  name="password" value="<?php print $password;?>" size="35" maxlength="20">
                            <?php 
                                if(isset($_SESSION['tmpPassword']) && $password==""){
                                    print '<br /><span style="color:red">* Please Enter Your Password</span>';
                                }
                            ?>
                            <div class="btns">
                            	<input type="submit" value="Log In" class="button">
                                
                        </fieldset>  
                    </form>   
                                               <br />
                               <a href="forgotPassword.php">
                                   Forgot Password
                               </a>

                
                
           </div>
            <div class="clear"></div>
        </div>
    </div>  
</section> 

<?php printFooter();?>