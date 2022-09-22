<?php

function getIP(){    
    $ipaddress = '';
     if (getenv('HTTP_CLIENT_IP')){
        $ipaddress = getenv('HTTP_CLIENT_IP'); 
     }         
     else if(getenv('HTTP_X_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
     else if(getenv('HTTP_X_FORWARDED'))
         $ipaddress = getenv('HTTP_X_FORWARDED');
     else if(getenv('HTTP_FORWARDED_FOR'))
         $ipaddress = getenv('HTTP_FORWARDED_FOR');
     else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
     else if(getenv('REMOTE_ADDR'))
         $ipaddress = getenv('REMOTE_ADDR');
     else
         $ipaddress = 'UNKNOWN'; 
     return $ipaddress;
}

function getSessionId(){
    $sessionID = session_id();
    return $sessionID;
}

function getDateTime(){
    $dateTime = date('m-d-Y G:i:s');
    return $dateTime;   
}

function logLogin($userId,$userName,$sessionId,$ipaddress,$userAgent,$success){
    $con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);
        
        $sql = "INSERT INTO `longoqrapp`.`loginAttempts` (
            `dbid` ,
            `userId` ,
            `userName` ,
            `sessionId` ,
            `ipAddress` ,
            `userAgent` ,
            `success` ,
            `dateTime`
            )
            VALUES (
            NULL , '" . $userId . "' , '" . $userName . "' , '" . $sessionId . "' , '" . $ipaddress . "' , '" . $userAgent . "' , '" . $success . "' , NOW()); ";
                
        try{
            if (mysql_query($sql, $con)) {
                $success = TRUE;
           }
           else{
               $success = FALSE;
           }            
        }
        catch(Execption $e){
            $errorMessage = $e->getMessage();
            echo "<p class='phpError'>Error Message: $errorMessage </p>";
        }

        closeMyConnection($con);
        return $success;  
}
?>
