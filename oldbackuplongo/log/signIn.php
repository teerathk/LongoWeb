<?php
session_start();
$_SESSION['userContext'] = 'log';
$userName = "";
$password = "";
if(isset($_GET["loginFailed"])){
	$tryAgain = TRUE;
        $userName = $_SESSION['tmpUserName'];
        $password = $_SESSION['tmpPassword'];
}
require '../php/globals.php';
$dbLocation = new locationDB();
$location = $dbLocation->getLocationName($_SESSION['location']);

$title = 'Longo Corporation - Time Log Access Login';
$description = 'This is the description';
$keywords = 'These are the keywords';

printHeadLog($title, $description, $keywords);
printHeaderLog();
?>

<!--==============================content================================-->


<section id="content">

    <div class="container_12">

    </div>
    <div class="aside">
        <div class="container_12">	
            <div class="grid_12">
                <h3>
                    Log Start/Stop time
                </h3>
                <br />
                <div>
                    <p>
                        <b>Location:</b>  <?php print $location ?>
                    </p>
                    <br />
                    <p>
                        <b>Current Time:</b> <?php print getCurrentDateTime();?>
                    </p>
                </div>
                <br />
                <p>
                    Please enter your user name and password to log your time
                </p>
                <?php
                    if(isset($tryAgain)){
                        print '<h2 style="color:red;text-align:center;">Log in failed</h2>';
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
                                <a onclick="document.getElementById('loginForm').submit()" class="button" href="#">
                                    Log In
                                </a>
                            </div>
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