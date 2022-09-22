<?php
// Inialize session

session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])) {
header('Location: index.php');
}


require '../php/globals.php';

$dbJobs = new jobDB();
$theJobs = new jobs(); 
$selEmployee = '';
$selLocation = '';
$selStartDate = '';
$selEndDate = '';
$selSort = '';

if(isset($_SESSION['searchParam'])){
    
    //  Get the values to poplute the form with previous selections to display to the user
    $selEmployee = $_SESSION['employeeSelection'];
    //unset($_SESSION['employeeSelection']);
    $selLocation = $_SESSION['locationSelection'];
    //unset($_SESSION['locationSelection']);
    $selStartDate = $_SESSION['startDateSelection'];
    //unset($_SESSION['startDateSelection']);
    $selEndDate = $_SESSION['endDateSelection'];
    //unset($_SESSION['endDateSelection']);
    $selSort = $_SESSION['sortSelection'];
    //unset($_SESSION['sortSelection']);
    
    $searchParameters = $_SESSION['searchParam'];
    //unset($_SESSION['searchParam']);
    
    
    $theJobs = $dbJobs->getJobsByParam($searchParameters);
    //$theJobs->drawResults($selSort);
}
else{
    $oneWeekAgo = oneWeekAgo();
    $searchParameters = ' AND timestamp_start > "' . $oneWeekAgo . '"';
	if($_SESSION['userRole']!='admin'){
		$searchParameters .=  ' AND jobs.employeeId IN (SELECT employees.employeeId FROM employees WHERE username = "' . $_SESSION['userName'] . '")';
	}
	$searchParameters .= ' ORDER BY timestamp_start DESC';
    $theJobs = $dbJobs->getJobsByParam($searchParameters);
    $defaultSearch = TRUE;
    $selSort = 'timestamp_start DESC';
    $selEndDate = date("n/j/Y");
    
    $selStartDate = date('n/j/Y',  strtotime($oneWeekAgo));
    //$theJobs->drawResults('timestamp_start DESC');
}


$title = 'Longo Corporation - Manage Jobs';
$description = '';
$keywords = '';

printHeadAdmin($title, $description, $keywords);
printHeaderAdmin();
?>

<!--==============================content================================-->


<section id="content">

    <div class="container_12">

    </div>
    <div class="aside">
        <div class="container_12">	

                <h3>
                   <?php
                   		if($_SESSION['userRole']=='admin'){
                   			print 'Manage Jobs';
                   		}
						else{
							print 'View Logged Time';
						}
						?> 
                </h3>
                <br />
                
                <?php
                if($_SESSION['userRole']=='admin'){
                   			print '<a class="button" href="updateJob.php?jobId=xxx"> Add New Time Log </a>
                <br /><br />';
                   		}
				?>
                
                
                <form id="searchJobs" method="POST" name="searchJobs" action="../php/jobSearch.php">
                    <div class="searchBox">
                        <h3 class="searchTitle">
                            Search Options
                        </h3>
                    <div class="half">
                        <label class="searchLabel">
                    Location:
                </label>
                        <select name="locations">
                    <?php  
                        $dbLocations = new locationDB();
                        $allLocations = $dbLocations->getAllLocations();
                        
                        $allLocations->printLocationOptions($selLocation);
                    ?>
                </select>
                <br />
                <?php if($_SESSION['userRole']=='admin'){?>
                <label class="searchLabel">
                    Employee:
                </label>
                <select name="employees">
                    <?php
                        $dbEmployees = new employeeDB();
                        $allEmployees = $dbEmployees->getAllEmployees();
                        $allEmployees->printEmployeeOptions($selEmployee);
                    ?>
                </select>
                <br />
                
                    <label class="searchLabel">
                        Paid Status:
                    </label>
                
                <select name="paid">
                    <option value="all"<?php
                        if(!isset($_SESSION['paid']) || $_SESSION['paid']=='all'){
                            print ' selected="selected"';
                        }
                    ?>>All</option>
                    <option value="0"<?php
                        if(isset($_SESSION['paid']) && $_SESSION['paid']=='0'){
                            print ' selected="selected"';
                        }
                    ?>>Unpaid</option>
                    <option value="1"<?php
                        if(isset($_SESSION['paid']) && $_SESSION['paid']=='1'){
                            print ' selected="selected"';
                        }
                    ?>>Paid</option>
                </select>
               <?php } ?>
                    </div>
                    <div class="half">
                        <span  class="searchLabel">
                            <label class="searchLabel">
                                Date Range:
                            </label>
                        </span>
                        
                        <input type="text" style="width: 125px;display:inline;" onclick="GetDate(this);" readonly="" value="<?php print $selStartDate;?>" name="startDate">
                        &nbsp;&nbsp;To&nbsp;&nbsp;
                        <input type="text" style="width: 125px;display:inline;" onclick="GetDate(this);" readonly="" value="<?php print $selEndDate;?>" name="EndDate">
                        <br />
                        <label class="searchLabel">
                            Sort By:
                        </label>
                        <select name="sort">
                            <option value="timestamp_start DESC"<?php
                            if($selSort=="timestamp_start DESC"){
                                print ' selected="selected"';
                            }?>>Date</option>
                            <option value="name"<?php
                            if($selSort=='name'){
                                print ' selected="selected"';
                            }
                            ?>>Location</option>
                            <?php if($_SESSION['userRole']=='admin'){?>
                            <option value="lastName"<?php
                            if($selSort=='lastName'){
                                print ' selected="selected"';
                            }
                            ?>>Employee</option>
                            <?php } ?>
                        </select>
                    </div>
                        <br />
                <div class="btns">
                    <input type="submit" value="Search" class="button">
                </div>
                    </div>
                
                <br />
                
                
                </form>
                
               <?php 
               if(isset($defaultSearch)){
                   print '<h2>Results for the past week</h2><br /><br />';
               }
               $theJobs->drawSearchResults($selSort);?>

                
                
         
            <div class="clear"></div>
        </div>
    </div>  
</section> 

<?php printFooter();?>