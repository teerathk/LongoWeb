<?php
require ('employees.php');

class employeeDB {
    
    private function setOneEmployee($row){
        $nextEmployee = new employee();
        $nextEmployee->setDBID($row[0]);
        $nextEmployee->setFirstName($row[1]);
        $nextEmployee->setLastName($row[2]);
        $nextEmployee->setPassword($row[3]);
        $nextEmployee->setUserName($row[4]); 
        $nextEmployee->setEmailAddress($row[5]);
        $nextEmployee->setRole($row[6]);
        $nextEmployee->setLastUpdated($row[7]);
        return $nextEmployee;
    }
    
    function getEmployeeByLogIn($userName,$password){
	$con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);
        $nextEmployee = new employee();
         $sql = "SELECT * FROM employees  WHERE userName = '" . $userName . "' AND password= '" . $password . "'";

        try{
            //  Exicute sql statement
            if ($result = mysql_query($sql, $con)) {
                //query ran without errors
                

                //  Loop through results and put data into employee object
                while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                        $nextEmployee = $this->setOneEmployee($row);
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
        return $nextEmployee;
        
    }
    
    function addNewEmployee(employee $newEmployee){
	$con = myConnection();        
        mysql_select_db($GLOBALS['dbName'], $con); 
        
        //  Create a sql statement
        $sql = "INSERT INTO employees ( `employeeId`, `firstName`, `lastName`, `password`, `userName`,`emailAddress`,`role`,`lastUpdated` ) ";
        $sql .= "VALUES (NULL, "; //    db will assign id
        $sql .= "'" . $newEmployee->getFirstName() . "', ";
        $sql .= "'" . $newEmployee->getLastName() . "', ";
        $sql .= "'" . $newEmployee->getPassword() . "', ";
        $sql .= "'" . $newEmployee->getUserName() . "', ";
        $sql .= "'" . $newEmployee->getEmailAddress() . "', ";
        $sql .= "'" . $newEmployee->getRole() . "', ";
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
    
    function getEmployeeByEmail($emailAddress){
	$con = myConnection();        
        mysql_select_db($GLOBALS['dbName'], $con); 

        $sql = 'SELECT * FROM employees  WHERE emailAddress = "' . $emailAddress . '"';
//print $sql;
        try{
            //  Exicute sql statement
            if ($result = mysql_query($sql, $con)) {
                //query ran without errors
                $nextEmployee = new employee();

                //  Loop through results and put data into employee object
                while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                        $nextEmployee = $this->setOneEmployee($row);
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
        return $nextEmployee;
    }
    
    
    
      function userNameAvailable($userName){
	$con = myConnection();        
        mysql_select_db($GLOBALS['dbName'], $con); 
        $numRows = 0;
        $sql = 'SELECT * FROM employees  WHERE userName = "' . $userName . '"';

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
        if($numRows==0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
        function checkEmailAvailable($email){
	$con = myConnection();        
        mysql_select_db($GLOBALS['dbName'], $con); 
        $numRows = 0;
        $sql = 'SELECT * FROM employees  WHERE emailAddress = "' . $email . '"';

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
        if($numRows==0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
            function verifyPassword($userName,$password){
	$con = myConnection();        
        mysql_select_db($GLOBALS['dbName'], $con); 
        $numRows = 0;
        $sql = 'SELECT * FROM employees  WHERE userName = "' . $userName . '" AND password = "' . $password . '"';

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
        if($numRows==1){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
    function editEmployee(employee $theEmployee){
    $con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);
        
        $sql = 'UPDATE employees SET `employeeId` =' . $theEmployee->getDBID() . ', 
                `firstName` = "' . $theEmployee->getFirstName() . '",
                `lastName` = "' . $theEmployee->getLastName() . '",
                `userName` = "' . $theEmployee->getUserName() . '",
                `emailAddress` = "' . $theEmployee->getEmailAddress() . '",
                `role` = "' . $theEmployee->getRole() . '",
                `lastUpdated` = NOW( ) 
                WHERE `employeeId` = ' . $theEmployee->getDBID() . ' LIMIT 1 ;';

        if (mysql_query($sql, $con)) {
            return TRUE;
	}
        else{
            return FALSE;
        }
	
        //  Close DB connection
        closeMyConnection($con);       
    }
    
      function updatePassword($userName,$password){
    $con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);
        
        $sql = 'UPDATE employees SET `password` = "' . $password . '",
                `lastUpdated` = NOW( ) 
                WHERE `userName` = "' . $userName . '" LIMIT 1 ;';

        if (mysql_query($sql, $con)) {
            return TRUE;
	}
        else{
            return FALSE;
        }
	
        //  Close DB connection
        closeMyConnection($con);       
    }
    
    function deleteEmployee($employeeId){
	$con = myConnection();        
        mysql_select_db($GLOBALS['dbName'], $con);       

        $sql = "DELETE from employees where employeeId = " . $employeeId . "; ";
        $sql2 = "DELETE from jobs WHERE employeeId = " . $employeeId . ";";
           

        try{
            //  Exicute sql statement
            if ($result = mysql_query($sql, $con)) {
                if($result = mysql_query($sql2, $con)){
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
    
    function getAllEmployees(){
	$con = myConnection();       
        mysql_select_db($GLOBALS['dbName'], $con);

        $sql = 'SELECT * FROM employees WHERE employeeID > 1 ORDER BY lastName';
        $allEmployees = new employees();
        try{
            //  Exicute sql statement
            if ($result = mysql_query($sql, $con)) {
                //query ran without errors
                $nextEmployee = new employee();

                //  Loop through results and put data into employee object
                while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                        $nextEmployee = $this->setOneEmployee($row);
                        $allEmployees->addEmployeetoArray($nextEmployee);
                }

                
            }
            else {
                echo 'There was a database error! ';
                return "";
            }             
        }
        catch(Execption $e){
            $errorMessage = $e->getMessage();
            echo "<p class='phpError'>Error Message: $errorMessage </p>"; 
        }
        
        //  Close the database connection
        closeMyConnection($con);
        //  Return  a single employee object
        return $allEmployees;
       
    }
    
    function getSingleEmployee($employeeId) {
	$con = myConnection();        
        mysql_select_db($GLOBALS['dbName'], $con);  

        //Create a sql statement
        $sql = 'SELECT * FROM employees WHERE employeeID = ' . $employeeId;
        
        try{
            //  Exicute sql statement
            if ($result = mysql_query($sql, $con)) {
                //query ran without errors
                $nextEmployee = new employee();

                //  Loop through results and put data into employee object
                while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                        $nextEmployee = $this->setOneEmployee($row);
                }

                //  Return  a single employee object
                return $nextEmployee;
            }
            else {
                echo 'There was a database error! ';
                return "";
            }            
        }
        catch(Exception $e){
            $errorMessage = $e->getMessage();
            echo "<p>Error Message: $errorMessage </p>";            
        }
        
        //  Close the database connection
        closeMyConnection($con);

        
    }
}
?>
