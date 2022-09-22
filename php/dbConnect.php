<?php


if(!defined('APP')) die();
function executeNonQuery($sql) {

    //Establish Connection
    $con = myConnection();
    
    try{
        //Select the database
        mysql_select_db($this -> dbname, $con);

        //Exicute sql statement
        if ($result = mysql_query($sql, $con)) {
                return true;
        } else {
                return false;
        }        
    }
    catch(Execption $e){
        $errorMessage = $e->getMessage();
        echo "<p>Error Message: $errorMessage </p>";       
    }

}

function executeSelectQuery($sql) {

    // Database Connection
    $con = myConnection();

    try{
        //  Select the database
        mysql_select_db($this -> dbname, $con);

        //  Execute the query
        if (mysql_query($sql, $con)) {
                $success = TRUE;
        } else {
                $success = FALSE;
        }                    
    }
    catch(Exception $e){
        $errorMessage = $e->getMessage();
        echo "<p>Error Message: $errorMessage </p>";
    }

}

function closeMyConnection($con) {
    try{
       mysql_close($con); 
    }
    catch(Excpection $e){
        $errorMessage = $e->getMessage();
        echo "<p>Error Message: $errorMessage </p>";
    }

}


/**
 * 
 * Connect to the database with credentials set in the globals file
 * 
 * Returns a database connection
 * (don't forget to close the connection with the function closeMyConnection
 */
function myConnection() {
    try{
        $con = mysql_connect($GLOBALS['dbHost'], $GLOBALS['dbUserName'], $GLOBALS['dbPassword']) or DIE('Connection to host is failed, perhaps the service is down!');

        return $con;
    }
    catch (Exception $e){
        $errorMessage = $e->getMessage();
        echo "<p>Error Message: $errorMessage </p>";   
    }
        
}
        


?>
