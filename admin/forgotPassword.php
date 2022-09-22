<?php

// Inialize session

session_start();



// Check, if user is already login, then jump to secured page

if (isset($_SESSION['userName'])) {

header('Location: admin.php');

}

$emailAddress = "";



if(isset($_GET["resetFailed"])){

	

	//	Get email address from previous attempt

	$tryAgain = TRUE;

    $emailAddress = $_SESSION['tmpEmailAddress'];

}

session_destroy();

require '../php/template.php';



$title = 'Longo Corporation - Forgot Password';

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
            <div class="container">
                <h3>

                    Reset Password

                </h3>

                <br />

                <?php

                	if(isset($_GET['passwordReset'])){

                	print '<h2>Your Password has been reset.</h2> <br />';

                	print '<p>Check your email for your new password</p><br />';

					print '<a class="button" href="index.php"> Click here to log in </a>';

					

				}

				else{

                ?>

                <p>

                    Please enter your email address, and an email will be sent to you with your user name and a new password.

                </p>

                

                <?php

                

                    if(isset($tryAgain)){

                        print '<h6 style="color:red;>Email address not found</h6>';

                    }

                ?>

                <br />

 <form action="resetPassword.php" method="post" name="forgotPasswordForm" id="forgotPasswordForm">

                        <fieldset>

                            <label>Email Address</label>

                            <?php 

                                if(isset($_SESSION['tmpEmailAddress']) && $emailAddress==""){

                                    print '<br /><span style="color:red">* Please Enter Your Email Address</span>';

                                }

                            ?>

                            <br />

                            <input type="text"  name="email" value="<?php print $emailAddress;?>" size="35" maxlength="30">

                            



                            <div class="btns">

                            	<input type="submit" value="Reset Password" class="button">

                                <?php

                                

                                    if(isset($_SESSION['userContext'])=='log'){

                                        $cancel = '../log';

                                    }

                                    else{

                                        $cancel = 'index.php';

                                    }

                                        

                                ?>

                                <a onclick="" class="button" href="<?php print $cancel;?>">

                                    Cancel

                                </a>

                            </div>

                            

                        </fieldset>  

                    </form>   

                    <?php } ?>

                                               <br />

                               <br />

                               <br />

                               <br />

                               <br />

                               



                

                

           </div>

            <div class="clear"></div>

        </div>

    </div>  
	</div>
</section> 



<?php printFooter();?>