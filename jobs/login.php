<?php
/**
 * Created by Mustafeez Ali (mtfz@msn.com).
 * Date: 5/2/2017
 * Time: 6:39 PM
 */

include_once "header.php";

// Check, if user is already login, then jump to secured page
if ( isset( $_SESSION['userName'] ) ) {
	//header( 'Location: ' . $baseLoc . "/jobs/" );
	echo "<script>window.open('".$baseLoc . "/jobs/login.php/','_self')</script>";
}

?>
<section id="content">
	<div class="container_12"></div>
    <div class="aside">
        <div class="container_12">
            <div class="grid_5">
                <div class="form-ctrl">
                    <p class="pset-login">Please enter your user name and password to log in.</p>

                    <form action="" method="post" name="loginForm" id="loginForm">

                        <p class="callbackError text-danger hide"></p>

                        <fieldset>
                            <label>User Name</label>
                            <br>
                            <input type="text" name="userName" value="">
                            <div class="text-danger hide formError"></div>
                            <br>

                            <label>Password</label>
                            <br>
                            <input type="password" name="password" value="">
                            <div class="text-danger hide formError"></div>
                            <br>

                            <div class="button-center">
                                <input id="cLogin" type="button" value="Log In" class="button-two">
                            </div>
                        </fieldset>
                    </form>

                    <div class="setp-login">
                        <a href="<?php echo $baseLoc ?>/admin/forgotPassword.php">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
//printFooter();
include_once "footer.php";
?>