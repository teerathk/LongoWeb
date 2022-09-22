<?php

function sendMessage(){
    $messageSent = FALSE;
    $errors = 0;
    
    if(trim($_POST['name'])=="" || is_null($_POST['name'])){
        $_SESSION['error']['name'] = "Please enter your name";
        $errors = $errors + 1;
    }
    
    if(trim($_POST['email'])=="" || is_null($_POST['email'])){
        $_SESSION['error']['email'] = "Please enter your email address";
        $errors = $errors + 1;
    }
    
    if(trim($_POST['message'])=="" || is_null($_POST['message'])){
        $_SESSION['error']['message'] = "Please enter a short message";
        $errors = $errors + 1;
    }elseif(strlen(($_POST['message']))< 7){
        $_SESSION['error']['message'] = "Please enter a longer message";
        $errors = $errors + 1;
    }
    
    if($errors==0){
        
        $message = "<h2 style=\"font-weight:bold;\">You have a new message from your website</h2>
                    <br/>
                    <br/>
                    <b>Sender Name: </b>" . $_POST['name'] . "
                        <br/>
                        <b>Sender Email Address: </b>" . $_POST['email'] . "
                            <br/>
                            <b>Message: </b>" . $_POST['message'];
        $headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: 4CastRealty.com<info@totonstv.com>' . "\r\n" . 'Reply-To: ' . $_POST['email'] . "\r\n" . 'X-Mailer: PHP/' . phpversion();
        if(mail("jseplak@gmail.com","Email message from 4castrealty.com",$message,$headers)){
            $messageSent = TRUE;
        }
        else{
            $messageSent = FALSE;
        }
        
    }
    else{
        $messageSent = FALSE;
    }

    return $messageSent;
    
}
?>
