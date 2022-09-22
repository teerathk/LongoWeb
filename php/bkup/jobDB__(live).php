<?php
$cwd =  getcwd();
require ('../php/jobs.php');



class jobDB {
    
    var $selectStatement = 'SELECT jobId, jobs.locationId, jobs.employeeId, timestamp_start, timestamp_end, lastName, firstName, name, comments, latitudeStart, longitudeStart, latitudeEnd, longitudeEnd, jobs.hourlyRate, paid
            FROM jobs, locations, employees WHERE jobs.locationId = locations.locationId AND 
            jobs.employeeId = employees.employeeId';
    
private function setOneJob($row){            
    $nextJob = new job();
    $nextJob->setDBID($row[0]);
    $nextJob->setLocationId($row[1]);
    $nextJob->setEmployeeId($row[2]);
    $nextJob->setStartTime($row[3]);
    $nextJob->setEndTime($row[4]);
    $nextJob->setEmployeeLastName($row[5]);
    $nextJob->setEmployeeFullName($row[6] . " " . $row[5]);
    $nextJob->setLocationName($row[7]);
    $nextJob->setComments($row[8]);
    $nextJob->setLattitudeStart($row[9]);
    $nextJob->setLongitudeStart($row[10]);
    $nextJob->setLattitudeEnd($row[11]);
    $nextJob->setLongitudeEnd($row[12]);
    $nextJob->setHourlyRate($row[13]);
    $nextJob->setIsPaid($row[14]);
    return $nextJob;
}



function getJobsByParam($parmameter){
    $con = myConnection();       
    mysql_select_db($GLOBALS['dbName'], $con);
    
   //Select the database to examine
        mysql_select_db($GLOBALS['dbName'], $con);

        //Create a sql statement
        $sql = $this->selectStatement . $parmameter;

        //  Exicute sql statement
        if ($result = mysql_query($sql, $con)) {
            //query ran without errors
            $jobArray = new jobs();            
                
            //  Loop through results and put data into job object
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {                
                $nextJob = $this->setOneJob($row);
                $jobArray->addJobtoArray($nextJob);
            }
            
            
            closeMyConnection($con);
            return $jobArray;
        }
        else {
            echo 'There was a database error! ';
            return NULL;
		}    
    
    
}
    
    function addJob(job $theJob){
        $con = myConnection();
        mysql_select_db($GLOBALS['dbName'], $con);

        //  Create a sql statement

        $sql = "INSERT INTO jobs ( `jobId`, `employeeId`, `locationId`, `timestamp_start`, `timestamp_end`, `comments`, `paid`,`lastUpdated`) ";
        $sql .= "VALUES (NULL, "; //    db will assign id
        $sql .= $theJob->getEmployeeId() . ", ";
        $sql .= $theJob->getLocationId() . ", ";
        $sql .= "'" . $theJob->getStartTime() . "' , ";
		if($theJob->getEndTime()==""||is_null($theJob->getEndTime())){
			$sql .= "NULL, "; //    End time will be null when creating a new job
		}
		else{
			$sql .= "'" . $theJob->getEndTime() . "', ";
		}                
        
        $sql .= "'" . $theJob->getComments() . "', "; 
		
		if($theJob!="0"){
			$sql .= "0" . ", ";
		}
		else{
			$sql .= $theJob->getIsPaid() . ", ";
		}
        //
        
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
    function getSingleJob($jobId) {
        $con = myConnection();
        mysql_select_db($GLOBALS['dbName'], $con);

        //Create a sql statement
        $sql = $this->selectStatement . ' AND jobs.jobID = ' . $jobId;

        //  Exicute sql statement
        if ($result = mysql_query($sql, $con)) {
            //query ran without errors
            $jobArray = new jobs();            
                
            //  Loop through results and put data into job object
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {                
                $nextJob = $this->setOneJob($row);
            }
            
            closeMyConnection($con);
            return $nextJob;
        }
        else {
            echo 'There was a database error! ';
            return "";
		}
        
    }
    
    function udateJobTimes($paid, $comments, $startDate, $endDate, $dbid){
        $con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);
        
        $sql = 'UPDATE jobs SET `jobId` =' . $dbid . ', 
                `timestamp_start` = ' . $startDate . ',
                `timestamp_end` = ' . $endDate . ',      
                `comments` = "' . $comments . '",      
                `paid` = ' . $paid . ',      
                `lastUpdated` = NOW( ) 
                WHERE `jobs`.`jobId` = ' . $dbid . ' LIMIT 1 ;';
				
        if (mysql_query($sql, $con)) {
            return TRUE;
	}
        else{
            return FALSE;
        }
	
        //  Close DB connection
        closeMyConnection($con);
    }
    
    function updateStartCoordinates($dbid, $latitudeStart, $longitudeStart){
        $con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);
        
        $sql = 'UPDATE jobs SET `latitudeStart` = "' . $latitudeStart . '", 
                `longitudeStart` = "' . $longitudeStart . '",
                `lastUpdated` = NOW( ) 
                WHERE `jobs`.`jobId` = ' . $dbid . ' LIMIT 1 ;';
				
        if (mysql_query($sql, $con)) {
            return TRUE;
	}
        else{
            return FALSE;
        }
	
        //  Close DB connection
        closeMyConnection($con);
    }
    
    function updateEndCoordinates($dbid, $latitudeEnd, $longitudeEnd){
        $con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);
        
        $sql = 'UPDATE jobs SET `latitudeEnd` ="' . $latitudeEnd . '", 
                `longitudeEnd` = "' . $longitudeEnd . '",
                `lastUpdated` = NOW( ) 
                WHERE `jobs`.`jobId` = ' . $dbid . ' LIMIT 1 ;';
				
        if (mysql_query($sql, $con)) {
            return TRUE;
	}
        else{
            return FALSE;
        }
	
        //  Close DB connection
        closeMyConnection($con);
    }
    
    function updateJob(job $aJob){
        $con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);
        
        $sql = "UPDATE jobs SET `jobId` =" . $aJob->getDBID() . ", 
                `locationId` = " . $aJob->getLocationId() .  ",
                `employeeId` = " . $aJob->getEmployeeId() . ",
                `timestamp_start` = '" . $aJob->getStartTime() . "',
                `timestamp_end` = '" . $aJob->getEndTime() . "',                    
                `lastUpdated` = NOW( ) 
                WHERE `jobs`.`jobId` = " . $aJob->getDBID() . " LIMIT 1 ;";

        if (mysql_query($sql, $con)) {
            return TRUE;
	}
        else{
            return FALSE;
        }
	
        //  Close DB connection
        closeMyConnection($con);
    }
    
    function deleteJob($id){
        $con = myConnection();
        mysql_select_db($GLOBALS['dbName'], $con);
        
        $sql = "DELETE FROM `jobs` WHERE `jobs`.`jobId` =" . $id;
        
        //  Run the query
        $success = mysql_query($sql, $con);

        //  Close DB connection
        mysql_close($con);
        return $success;
    }
    
     function getAllJobs() {
        $con = myConnection();
        mysql_select_db($GLOBALS['dbName'], $con);

        //Create a sql statement
        $sql = $this->selectStatement;
        
        //  Exicute sql statement
        if ($result = mysql_query($sql, $con)) {
            //query ran without errors
            $jobArray = new jobs();            
                
            //  Loop through results and put data into job object
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {                
                $nextJob = $this->setOneJob($row);
                $jobArray->addJobtoArray($nextJob);
            }
            
            
            $db->closeConnection();
            return $jobArray;
        }
        else {
            echo 'There was a database error! ';
            return NULL;
		}
        
    }
    
    function getOpenJobsEmployeeLocation($employeeId,$locationId){
        $con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);
        
        $sql = $this->selectStatement  . " AND jobs.employeeId = " . $employeeId  . " AND jobs.locationId = " . $locationId . " AND timestamp_end IS NULL AND timestamp_start > '" . oneDayAgo() . "' ORDER BY timestamp_start DESC";

        //  Exicute sql statement
        if ($result = mysql_query($sql, $con)) {
            //query ran without errors
            $jobArray = new jobs();            
                
            //  Loop through results and put data into job object
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {                
                $nextJob = $this->setOneJob($row);
                $jobArray->addJobtoArray($nextJob);
            }
            
            closeMyConnection($con);
            if(isset($jobArray)){
                return $jobArray;
            }
            else{
                return NULL;
            }
        }
        else {
            echo 'There was a database error! ';
            return NULL;
		}        
    }
    

}
?>
