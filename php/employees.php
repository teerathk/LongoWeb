<?php

include 'employee.php';

class employees {
    var $allEmployees = array();
    
    /**
     * This function add a single employee to the class variable $allemployees
     * @param employee $singleEmployee an employee object
     */
    function addEmployeetoArray(employee $singleEmployee) {
        //This function handles adding a single employee, and will be called for each tv within a given "set"
        $this ->allEmployees[count($this ->allEmployees) + 1] = $singleEmployee;
    }
    
    
     function printEmployeeOptions($select){
         
        print '<option value="all">All Employees</option>';
        foreach ($this->allEmployees as $theEmployee){
            $dbID = $theEmployee->getDBID();
            $locationName = $theEmployee->getFullName();
            print '<option value="' . $dbID  . '"';
            if($select==$dbID){
                 print ' selected="selected"';
            }
            print  '>' . $locationName . '</option>';
    }
    }
    
    function count(){
        count($this->allEmployees);
    }
    
    function printEmployeeList(){
        print '<table class="searchTable">
                <tr class="searchHeaderRow">
        <td width="225px">
            <span class="searchHeader">
                Employee Name
            </span>
        </td>
        <td width="125px">
            <span class="searchHeader">
                User Name
            </span>
        </td>
        <td width="200px">
            <span class="searchHeader">
                Email Address
            </span>
        </td>
        <td width="125px">
            <span class="searchHeader">
                Role
            </span>
        </td>
        <td width="175px">
            <span class="searchHeader">
                
            </span>
        </td>
        </tr>';
        
        $totalCount = count($this->allEmployees);
        $i = 1;
        foreach($this->allEmployees as $theEmployee){
            $e = new employee();
            $e = $theEmployee;
            if($i&1) {
                $rowClass = 'oddRow';
            }
            else{
                $rowClass = 'evenRow';
            }
            
            $id = $e->getDBID();
            $firstName = $e->getFirstName();
            $lastName = $e->getLastName();
            $email = $e->getEmailAddress();
            $userName = $e->getUserName();
            $role = $e->getRole();
			$needPassword = $e->needPassword();
            print '<tr class="' . $rowClass . '">';
            print '<td>' . $lastName . ", " . $firstName . '</td>';
            print '<td>' . $userName . '</td>';
            print '<td>' . $email . '</td>';
            print '<td>' . $role . '</td>';
            print '<td><a class="button" href="updateUser.php?userId=' . $id . '"> Update </a>';
			
           
			
            print '        <a class="button" href="updateUser.php?delid=' . $id . '" onclick="if( !confirm(\'Are you sure you want to delete this user? Any Jobs associated with this user will be deleted as well. \') ) { return false; }"> Delete </a>';
            
             print '<br />';
             if($needPassword==TRUE){
		   		print '
		   			<form id="resendPassword" method="POST" name="resendPassword" action="../php/resendPassword.php">
		   			<input type="hidden" name="dbid" value="' . $id . '">
		   			<input class="button passwordButton reset" type="submit" value="Resend Password">
		   			</form>';
		   		
		   }
		   else{
		   		print '<form id="forgotPasswordForm" name="forgotPasswordForm" method="post" action="resetPassword.php">
		   			<input type="hidden" name="email" value="' . $email . '">
		   			<input type="hidden" name="directTo" value="manageUsers">
		   			<input class="button passwordButton" type="submit" value="Reset Password">
		   			</form>';
		   		
		   };
            print '</td></tr>';
                    
            if($i == $totalCount){
                print '</table>';
            }
            else{
                $i = $i + 1;
            }
        }
        print '</ul>';
    }
    
    
}
?>
