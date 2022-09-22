<?php
// Inialize session
if($_COOKIE['ses_id']){
    session_id($_COOKIE['ses_id']);
}
session_start();

$emialMessage = "<div style=\"width:100\">
    <h1>
        Welcome to the Longo Time Log System
    </h1>
    
    <br />
    
    <p>
        Name: " .  $_SESSION['passwordReset']['fullName']  . "
    </p>
    <p>
        User Name: " .  $_SESSION['passwordReset']['userName'] . "
    </p>
    <p>
        Temporary Password: " .  $_SESSION['passwordReset']['newPassword'] . "
    </p>
    <br />

    <p>
        Your Password has been reset. 
    </p>
    <br />
    <h3>
        Log in instructions
    </h3>
    <br />
    <p>
        Your login information is above.  You have been assigned a temporary password.  
        The first time you log in, you will be prompted to change your password to something 
        that is easier for you to remember.  You can change your password by clicking on the link below.
    </p>
    <br />
    <a href=\"http://www.longocorporation.com/admin/\">Click here to change your password</a>
    
    <br />
    <p>
        If you have any questions, please contact Joe Longo
    </p>
</div>";


// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: Longo Corporation <noreply@longocorporation.com>' . "\r\n";
$to = $_SESSION['passwordReset']['email'];
$subject = 'Longo Time Log Access - Password Rest';
mail($to, $subject, $emialMessage, $headers,'-f ' . $to);
?>