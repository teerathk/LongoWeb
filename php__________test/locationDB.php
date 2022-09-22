<?php
require ('../php/locations.php');


class locationDB {
    
   function getLocationName($locationId){
	$con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);

        $sql = "SELECT name FROM locations  WHERE locationId = " . $locationId . ";";

        try{
            //  Exicute sql statement
            if ($result = mysql_query($sql, $con)) {
                
                //query ran without errors
                //  Loop through results and put data into employee object
                while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                        $locationName = $row[0];
                }
           }
            else {
                echo 'There was a database error! ';
            }            
        }
        catch(Exception $e){
            $errorMessage = $e->getMessage();
            echo "<p class='phpError'>Error Message: $errorMessage </p>";            
        }
        
        //  Close the database connection
        closeMyConnection($con);
        return $locationName;
        
    }
    
        function deleteLocation($locationId){
	$con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);        

        $sql = "DELETE from locations where locationId = " . $locationId . "; ";
        $sql2 = "DELETE from jobs WHERE locationId = " . $locationId . ";";
           

        try{
            //  Exicute sql statement
            if ($result = mysql_query($sql, $con)) {
                if ($result = mysql_query($sql2, $con)){
                    $success = TRUE;
                }
                
            } else {
                $success = FALSE;
            }
        }
        catch(Exception $e){
            $errorMessage = $e->getMessage();
            echo "<p class='phpError'>Error Message: $errorMessage </p>"; 
        }
        
        closeMyConnection($con);
        return $success;
    }
    
    function locationAvailable($locationId){
    	$con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);

        $sql = "SELECT * FROM locations WHERE locationId = " . $locationId;
        try{
            $result = mysql_query($sql, $con);
                
                $numRows = mysql_num_rows($result);
                

        }
        catch(Exception $e){
            $errorMessage = $e->getMessage();
            echo "<p class='phpError'>Error Message: $errorMessage </p>"; 
        }
        
        //  Close the database connection
        closeMyConnection($con);
        if($numRows>0){
            return FALSE;
        }
        else{
            return TRUE;
        }
        
        
    }
    
    function addNewLocation(location $theLocation){
        $con = myConnection();        
        mysql_select_db($GLOBALS['dbName'], $con); 
        
        //  Create a sql statement
        $sql = "INSERT INTO locations ( `locationId`, `name`,`lastUpdated` ) ";
        $sql .= "VALUES (" . $theLocation->getDBID() . ", "; //    
        $sql .= "'" . $theLocation->getName() . "', ";
        $sql .= "NOW()); "; //  db will add a timestamp with this function
        
        
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
    
    function updateLocation(location $theLocation,$oldLocationId){
        $con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);
        
        $theId = $theLocation->getDBID();
        $theName = $theLocation->getName();

        $sql = 'UPDATE locations SET `locationId` = ' . $theId . ',
                `name` = "' . $theName . '",
                `lastUpdated` = NOW( ) 
                WHERE `locationId` = ' . $oldLocationId . ' LIMIT 1 ;';
				
		$sql2 = 'UPDATE jobs SET `locationId` = ' . $theId . ', 
			`lastUpdated` = NOW( ) 
                WHERE `locationId` = ' . $oldLocationId . ' LIMIT 1 ;';
		
        
        if (mysql_query($sql, $con)) {
        	if(mysql_query($sql2,$con)){
        		return TRUE;
        	}
            
	}
        else{
            return FALSE;
        }
	
        //  Close DB connection
        closeMyConnection($con);
    }
    
    
     function getAllLocations(){
	$con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);

        $sql = "SELECT * FROM locations ORDER BY name;";
        $allLocations = new locations();
        try{
            
            
            //  Exicute sql statement
            if ($result = mysql_query($sql, $con)) {
                
                //query ran without errors
                //  Loop through results and put data into employee object
                while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                    $theLocation = new location();
                        $theLocation->setDBID($row[0]);
                        $theLocation->setName($row[1]);
                        $allLocations->addLocationtoArray($theLocation);
                        
                        
                }
           }
            else {
                echo 'There was a database error! ';
            }            
        }
        catch(Exception $e){
            $errorMessage = $e->getMessage();
            echo "<p class='phpError'>Error Message: $errorMessage </p>";            
        }
        
        //  Close the database connection
        closeMyConnection($con);
        return $allLocations;
        
    }
    
        function getLocationById($dbid){
	$con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);

        $sql = "SELECT * FROM locations WHERE locationId = " . $dbid ;
        $allLocations = new locations();
        try{
            
            $theLocation = new location();
            //  Exicute sql statement
            if ($result = mysql_query($sql, $con)) {
                
                //query ran without errors
                //  Loop through results and put data into employee object
                while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                    
                        $theLocation->setDBID($row[0]);
                        $theLocation->setName($row[1]);
                        
                        
                        
                }
           }
            else {
                echo 'There was a database error! ';
            }            
        }
        catch(Exception $e){
            $errorMessage = $e->getMessage();
            echo "<p class='phpError'>Error Message: $errorMessage </p>";            
        }
        
        //  Close the database connection
        closeMyConnection($con);
        return $theLocation;
        
    }
    
}
?>