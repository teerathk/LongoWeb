<?php
// Inialize session

session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])) {
header('Location: index.php');
}


require '../php/globals.php';

$dbJobs = new jobDB();
$theJob = new job(); 
if($_GET['jobId']=='xxx'){
	$theJob = new job;
	$theJob->setStartTimeNow();
	$theJob->setDBID('xxx');
	$newJob = TRUE;
	
	
}else{
	$newJob = FALSE;
	$theJob = $dbJobs->getSingleJob($_GET['jobId']);
	
}

$startTimeArray = $theJob->getStartTimeHrMinArray();
	$startHour = $startTimeArray[0];
	$startMin = $startTimeArray[1];
	$startAmpm = $startTimeArray[2];





$endHour = '';
$endMin = '';
$endAmpm = '';
$endTime = $theJob->getEndTime();

if($endTime==''||$endTime=='0000-00-00 00:00:00'){
    $excludeEndTime = TRUE;
}
else{
    $excludeEndTime = FALSE;
    $endTimeArray = $theJob->getEndTimeHrMinArray();
   $endHour = $endTimeArray[0];
   $endMin = $endTimeArray[1];
   $endAmpm = $endTimeArray[2]; 
}

$comments = $theJob->getComments();
$paid = $theJob->getIsPaid();



$title = 'Longo Corporation - Update Job';
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
                    Update Job
                </h3>
                <br />
                
                <form id="updateJob" method="POST" name="updateJob" id="updateJob" action="../php/updateJob.php">
                    <input type="hidden" name="jobId" value="<?php print $theJob->getDBID();?>">
                    <div class="">


                   <span>
                       <b>Location:</b>
                   </span>
                        <span>
                            <?php 
                            if($newJob == TRUE){
                         print '<select name="locations">';   	 
                        $dbLocations = new locationDB();
                        $allLocations = $dbLocations->getAllLocations();                        
                        $allLocations->printLocationOptions($selLocation);
						print '</select>';
                    
                            }else{
                            	print $theJob->getLocationName();
                            }
                            ?>	
                        </span>
                <br />
                <span>
                    <b>Employee:</b>
                </span>
                <span>
                	<?php 
                            if($newJob == TRUE){
                            	print '<select name="employees">';
                            	$dbEmployees = new employeeDB();
		                        $allEmployees = $dbEmployees->getAllEmployees();
		                        $allEmployees->printEmployeeOptions($selEmployee);
								print '</select>';
                            }else{
                            	print $theJob->getEmployeeFullName();
                            }
                            ?>
                    
                </span>
                    
                <br />
                <span width="200px">
                    <b>Start Time:</b>
                </span>

                <input type="text" name="startDate" value="<?php print $theJob->getDatePickerStartDate();?>" readonly="" onclick="GetDate(this);" style="width: 125px;display:inline;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="startHour">
                        <option value=""></option>
                        <?php
                            for($i=1; $i<=12; $i++){
                                print '<option value="' . $i . '"';
                              if($startHour == $i){
                                  print ' selected="selected"';
                              }                            
                             print '>' . $i . '</option>';
                            }
                        ?>
                    </select> &nbsp;&nbsp;:&nbsp;&nbsp;
                    <select name="startMinute">
                        <option value="0"></option>
                        <?php
                            for($i=0; $i<=59; $i++){
                                if($i < 10 ){
                                    $min = "0" . $i;
                                }
                                else{
                                    $min = $i;
                                    
                                }
                                
                                print '<option value="' . $i . '"';
                                if($startMin==$min){
                                    print ' selected="selected"';
                                }
                                print '>' . $min . '</option>';
                            }
                        ?>
                    </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="startAmpm">
                        <option value="AM"></option>
                        <option value="AM"<?php 
                        if($startAmpm=='AM'){print ' selected="selected"';}?>>
                            AM
                        </option>
                        <option value="PM"<?php 
                        if($startAmpm=='PM'){print ' selected="selected"';}?>>
                            PM
                        </option>
                    </select>
                
                <br />
                <span>
                    <b>End Time:</b>
                </span>
                
                    <input type="text" name="endDate" id="endDate" value="<?php print $theJob->getDatePickerEndDate();?>" readonly="" onclick="GetDate(this);" style="width: 125px;display:inline;"  onChange="checkChecked()">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="endHour" id="endHour"  onChange="checkChecked()">
                        <option value="0"></option>
                        <?php
                            for($i=1; $i<=12; $i++){
                                print '<option value="' . $i . '"';
                                if($endHour==$i){
                                    print ' selected="selected"';
                                }                           
                                
                               print '>' . $i . '</option>';
                            }
                        ?>
                    </select> &nbsp;&nbsp;:&nbsp;&nbsp;
                    <select name="endMinute" id="endMinute"  onChange="checkChecked()">
                        <option value="0"></option>
                        <?php
                            for($i=0; $i<=59; $i++){
                                if($i < 10 ){
                                    $min = "0" . $i;
                                }
                                else{
                                    $min = $i;
                                    
                                }
                                
                                print '<option value="' . $i . '"';
                                if($endMin==$min){
                                    print ' selected="selected"';
                                }   


                                print '>' . $min . '</option>';
                            }
                        ?>
                    </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="endAmpm" id="endAmpm"  onChange="checkChecked()">
                        <option value=""></option>
                        <option value="AM"<?php if($endAmpm=='AM'){print ' selected="selected"';}?>>
                            AM
                        </option>
                        <option value="PM"<?php if($endAmpm=='PM'){print ' selected="selected"';}?>>
                            PM
                        </option>
                    </select>
                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="excludeEndTime" id="excludeEndTime" onclick="checkExclude()" value="exclude"  <?php 
                if($excludeEndTime==TRUE){
                    print 'checked="checked"';
                }
                    ?>/>
                &nbsp;&nbsp;&nbsp;&nbsp;Exclude End Time
                <br /> 
                <b>Paid:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="checkbox" name="paid" id="paid" value="paid" <?php
                if($paid==1){
                                    print ' checked="checked"';
                                }  
                
                ?>/>
                <br />
                
                <b>Comments:</b> 
                <textarea name="comments" id="comments" style="width:500px;height:50px;"><?php print $comments;?></textarea>
                
                   
                    </div>
                </form>
                        <br />
                <div class="btns">
                    <a class="button" href="#" onclick="document.getElementById('updateJob').submit()"> <?php
                    
                    if($newJob==TRUE){
                    	print 'Add Job';
					}
					else{
						print 'Update Job';
					}
                   	?></a>
                    <a class="button" href="manageJobs.php"> Cancel</a>
                    
                </div>
                    </div>
                
                <br />
                
                
                </form>
                
               

                
                
         
            <div class="clear"></div>
        </div>
    </div>  
</section> 

<?php printFooter();?>