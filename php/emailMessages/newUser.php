<?php
$emialMessage = "<div style=\"width:100\">
    <h1>
        Welcome to the Longo Time Log System
    </h1>
    
    <br />
    
    <p>
        Name: " .  $_SESSION['newUser']['fullName']  . "
    </p>
    <p>
        User Name: " .  $_SESSION['newUser']['userName'] . "
    </p>
    <p>
        Temporary Password: " .  $_SESSION['newUser']['password'] . "
    </p>
    <br />
    <p>
    Welcome,
    </p>
    <p>
        An account has been set up for you on the Longo Time Log System. 
        This system will be used to document start and stop times for each job. 
        You will need your smart phone and have interent access on your phone.  
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
$to = $_SESSION['newUser']['email'];
$subject = 'Longo Time Log Access';
mail($to, $subject, $emialMessage, $headers,'-f ' . $to);


?>
