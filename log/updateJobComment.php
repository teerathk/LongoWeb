<?php
//session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../php/globals.php';
date_default_timezone_set ($GLOBALS['timeZone']);
if(isset($_SESSION['userName'])){
    
    if(isset($_POST['iscomment']) == "commentupdate"){
        
        $conn = myConnection();
        
        mysql_select_db($GLOBALS['dbName'], $conn);

        $uid = $_POST['userid'];
        
        $loc = $_POST['location'];
        
        $lat = $_POST['lat'];
        
        $lng = $_POST['lng'];
        
        $formatted_address = $_POST['format'];
        
        

        $entime = date("Y-m-d H:i:s"); 
        //$entime = ''; //date("Y-m-d H:i:s");
        
        $get = mysql_query("SELECT jobId FROM jobs WHERE employeeId = $uid AND locationId = $loc ORDER BY jobId DESC LIMIT 1");
        
        while ($row = mysql_fetch_array($get)) {
        
            $lastid = $row['jobId'];
        
            
        }

        $comments = $_POST['comments'];
        
        $sql = "UPDATE jobs SET ecomments = '".$comments."', timestamp_end = '".$entime."', latitudeEnd = '".$lat."', longitudeEnd = '".$lng."', lastUpdated = NOW(), end_location = '".$formatted_address."' WHERE `jobId` = '".$lastid."' ";        
        
        
        if (mysql_query($sql, $conn)){
        
            return "Comment Submitted Successfully";
        
            
        }        
        else{
            
           return "Error Updating Comment: " . mysql_error($conn);
           
        }
        
    }
    
}
else {
    
    header('Location: index.php');
    
}