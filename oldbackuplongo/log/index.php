<?php
// Inialize session
if($_COOKIE['ses_id']){
    session_id($_COOKIE['ses_id']);
}
session_start();

/*
 * This file handles the input for logging a new job
 * It will take the location parameter, check the value
 * of the passcode.  If both are set, they will be set to 
 * sessions variables, and a user will either be directed to
 * the log in page or to logTime script depending if they are
 * logged in.
 */

//  This is needed to direct a user after they successfully log in
$_SESSION['userContext'] = 'log';

//  Test to see if there is a location and pass parameter
if(isset($_GET['location'])&&isset($_GET['pass'])){
    
    //  Set location Id to session to be processed later
    $_SESSION['location'] = $_GET['location'];
    if ($_GET['pass']=='Ut6l9b2d7rtfoB7sF') {
        
        //  Pass code matches
        $_SESSION['pass'] = TRUE;   //  localhost/longo/log/?location=1&pass=Ut6l9b2d7rtfoB7sF
    }
    else{
        
        //  Pass code does not match
        print '<p>There has been an error</p>';
    }
    //  Code to get location name

    
}

if(isset($_SESSION['pass']) && $_SESSION['pass'] == TRUE){
    
    /*
     * We have a passcode and location Id, now direct user to 
     * login page if not logged in, or direct them to the
     * logTime script to process the event
     */
    if (isset($_SESSION['userName'])) {
        header('Location: logTime.php');
    }
    else{
        header('Location: signIn.php');
    }
}
else{
    //  A user has not scanned the bar code
    print '<p>You must scan the QR code to log the job time</p>';
}


?>