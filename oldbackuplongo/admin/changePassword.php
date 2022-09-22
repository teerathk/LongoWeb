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

//  check to see if user was directed here from login.php
if(!isset($_SESSION['updatePassword'])){
    header('Location: index.php');
}

        $currentPassword = "";
       $newPassword = "";
       $confirmPassword = "";


//  
if(isset($_GET["resetFailed"])){
       $tryAgain = TRUE;
    
       $currentPassword = $_SESSION['resetPassword']['currentPassword'];
       $newPassword = $_SESSION['resetPassword']['newPassword'];
       $confirmPassword = $_SESSION['resetPassword']['confirmPassword'];
}

require '../php/template.php';

$title = 'Longo Corporation - Change Password';
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
        <?php
            if(isset($_SESSION['passwordReset'])){?>
                <h3>
                    Password Updated
                </h3>
                <br />
                <p>
                    Your password has been updated.
                </p>
                
            <?php
            unset($_SESSION['passwordReset']);
			$_SESSION['resetPassword'];
            unset($_SESSION['updatePassword']);
            
            }
            else{?>
                
            <div class="grid_12">
                <h3>
                    Change Password
                </h3>
                <br />
                <p>
                    Please enter the information below to change your password.
                </p>
                <?php
                    if(isset($tryAgain)){
                        print '<h2 style="color:red;text-align:center;">Please Correct the errors below</h2>';
                    }
                ?>
                <br />
 <form action="../php/updatePassword.php" method="post" name="updatePassword" id="changePassword">
                        <fieldset>
                            <label>Current Password</label>
                            <br />
                            <?php 
                                if(isset($_SESSION['resetPassword']['errors']['currentPassword'])){
                                    print '<p class="errorMessage">' . $_SESSION['resetPassword']['errors']['currentPassword'] . '</p>';
                                }
                            ?>
                            
                            <input type="password"  name="currentPassword" value="<?php print $currentPassword;?>" size="35" maxlength="30">
                            <br />
                            
<label>New Password</label>
                            <?php 
                                if(isset($_SESSION['resetPassword']['errors']['newPassword'])){
                                    print '<p class="errorMessage">' . $_SESSION['resetPassword']['errors']['newPassword'] . '</p>';
                                }
                            ?>
                            <br />
                            <input type="password"  name="newPassword" value="<?php print $newPassword;?>" size="35" maxlength="30">                            
                            <br />
<label>Confirm New Password</label>
                            <?php 
                                if(isset($_SESSION['resetPassword']['errors']['confirmPassword'])){
                                    print '<p class="errorMessage">' . $_SESSION['resetPassword']['errors']['confirmPassword'] . '</p>';
                                }
                            ?>
                            <br />
                            <input type="password"  name="confirmPassword" value="<?php print $confirmPassword;?>" size="35" maxlength="30">                            
                            
                            
                            
                            
                            
                            
                            

                            <div class="btns">
                                <input type="submit" value="Reset Password" class="button">

                            </div>
                            
                        </fieldset>  
                    </form>   
                
                <?php } ?>
                                               <br />
                               <br />
                               <br />
                               <br />
                               <br />
                               
                               <?php
                               	if(isset($_SESSION['userContext']) && $_SESSION['userContext']=='log'){
                               		print '<a href= \"../log/logTime.php\">Click here to complete logging your time</a>';
                               	}
								
                               ?>
                               

                
                
           </div>
            <div class="clear"></div>
        </div>
    </div>  
</section> 

<?php printFooter();?>

