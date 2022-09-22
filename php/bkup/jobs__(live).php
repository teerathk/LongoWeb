<?php
include 'job.php';

class jobs {

    var $allJobs = array();
    var $sortKey = '';

    /**
     * This function add a single job to the class variable $allJobs
     * @param job $singleJob a job object
     */
    function addJobtoArray(job $singleJob) {
        //This function handles adding a single job, and will be called for each job within a given "set"
        $this->allJobs[count($this->allJobs)] = $singleJob;
    }

    function getCount() {
        return count($this->allJobs);
    }

    function getFirstIndexJob() {
        return $this->allJobs[0];
    }

    function drawSearchResults($sortKey) {

        if(count($this->allJobs)==0){
        	
			//	Display message to user if no results have been found
        	if($_SESSION['userRole']=='admin'){
        		print '<h2>Your search returned zero results</h2>';
        	}
			else{
				print '<p>You have no recent jobs in the system with the above search parameters.  This page will show all jobs logged by you
				within the past week by default.  You can filter the results by location and/ or a date range.
				You can access this page at any time to view the time information for recent jobs that you have
				scanned the QR bar code for.</p>
				<br />
				<p>If you have any questions, please contact Joseph Longo</p>';
			}
        }
		
		//	initialize variable for dealing with groupings(Date,Employee, or location)
        $currentIndex = '';
        $previousIndex = '';
        $currentRecord = 1;
        $newSection = TRUE;
        $isFirst = TRUE;
		
		//	Get the number of results for this search
		$count = $this->getCount();
		
		//	initialize running total for the grouping (Date,Employee, or location)
        $totalSectionTime = 0;
		
		//	Determine what we are grouping the results by
        if ($sortKey == 'timestamp_start DESC') {
            $sortKey = 'date';
        } elseif ($sortKey == 'employeeId') {
            $sortKey = 'employee';
        } elseif ($sortKey == 'locationId') {
            $sortKey = 'location';
        }

        foreach ($this->allJobs as $nextJob) {
            
			//	initialize the new job object
            $theJob = new job();
            $theJob = $nextJob;
			
			//	currentIndex and previous index are variables that contain the title for a grouping
			//	For example if we are sorting by date, these values would look like "January 18, 2012"
            $previousIndex = $currentIndex;
            $currentIndex = '';
			
			//	Set css class for this record 
            if ($currentRecord & 1) {
            	//	Grey background color
                $rowClass = "oddRow";
            } else {
            	//	White background color
                $rowClass = "evenRow";
            }
			
			//	Set value of current index based on the sort type
            if ($sortKey == 'date') {
                $currentIndex = $theJob->getStartDateLong();
            } elseif ($sortKey == 'lastName') {
                $currentIndex = $theJob->getEmployeeFullName();
            } elseif ($sortKey == 'name') {
                $currentIndex = $theJob->getLocationName();
            }

            if ($previousIndex == '') {
            	//	This is the very first record and will start a new grouping
                $newSection = TRUE;
            } elseif ($currentIndex != $previousIndex) {
            	//	The current index is differeent from the last, star a new grouping
                $newSection = TRUE;
            } else {
            	//	This record will be grouped with the last record
                $newSection = FALSE;
            }

            if ($newSection == TRUE) {
                if ($isFirst == TRUE) {
                    $isFirst = FALSE;
                    
                } else {
                	//	Get the total time for all records in this grouping
                	//	This is the last item in this grouping, display total for this grouping to the user
                	if($totalSectionTime==0){
                		$totalSectionTime = "0:00";
                	}
					else{
						$totalSectionTime = timeDifHoursMinsFromSec($totalSectionTime);
					}
                    
                    print '<tr class="searchHeaderRow"><td colspan="4"> <b>Total Time </b></td><td><b>' . $totalSectionTime . '</td><td></td><td></td></tr>';
                    print '</table><br /><br />';
					
					//	Reset the total to 0 for the next grouping
                    $totalSectionTime = 0;
                }
				
				//	This is the first record of a new grouping, print the title and header row for this new grouping

?>

<h3> <?php print $currentIndex; ?>
</h3>
<br />
<div id="hoverDiv"></div>
<div class="searchDiv">
	<table class="searchTable">
		<tr class="searchHeaderRow">
			<td width="200px"><span class="searchHeader"> Location Name </span></td>
			<td width="125px"><span class="searchHeader"> Employee Name </span></td>
			<td width="125px"><span class="searchHeader"> Start Time </span></td>
			<td width="125px"><span class="searchHeader"> End Time </span></td>
			<td width="75px"><span class="searchHeader"> Duration </span></td>
                        <td width="50px"><span class="searchHeader"> Paid </span></td>
			<td width="180px"> &nbsp; </td>
		</tr>

		<?php
		//	End of table header
		}
		//	Add the total time for this job to the running total for this grouping
                $jobSeconds = $theJob->totalSeconds();
				
                if($jobSeconds> -1 || $jobSeconds < 10000){
                    $totalSectionTime = $totalSectionTime + $jobSeconds;
                }
		

		//	Print the record/row
		?>

		<tr class="<?php print $rowClass; 
                
                
                    if($theJob->getComments()!= ""){
                        print ' hoverLink" ';
                        print ' hovertext="' . htmlspecialchars($theJob->getComments());
                    }
                ?>">
			<td> <?php print $theJob -> getLocationName(); ?>
			</td>
			<td> <?php print $theJob -> getEmployeeFullName(); ?>
			</td>
			<td> <?php print $theJob -> getDisplayStartTime(); ?>
                            
                <?php if($_SESSION['userRole']=='admin'){
                        if($theJob->getLattitudeStart()!=""){?>
                            <br />
                            <a href="<?php print $theJob->getGoogleMapsLinkStart();?>" target="_blank" class="locationLink">
                                Location
                            </a>
                <?php } 
                
                        }   
                ?>            
                           
			</td>
			<td> <?php print $theJob -> getDisplayEndTime(); ?>
		<?php if($_SESSION['userRole']=='admin'){
                        if($theJob->getLattitudeEnd()!=""){?>
                            <br />
                            <a href="<?php print $theJob->getGoogleMapsLinkEnd();?>" target="_blank" class="locationLink">
                                Location
                            </a>
                <?php } 
                
                        }   
                ?> 	
                        
                        </td>
			<td> <?php print $theJob -> getDuration(); ?>
			</td>
                        <td>
                            <?php
                                if($theJob ->getIsPaid()== 0){
                                    print 'No';
                                }
                                else{
                                    print 'Yes';
                                }
                            ?>
                        </td>

			<td> <?php

//	Add the update and delete buttons if current user is an admin
if($_SESSION['userRole']=='admin'){ ?>
			<a class="button" href="updateJob.php?jobId=<?php print $theJob -> getDBID(); ?>"> Update </a>
			<a class="button" href="../php/updateJob.php?delid=<?php print $theJob -> getDBID(); ?>" onclick="if( !confirm('Are you sure you want to delete this job?') ) { return false; }"> Delete </a> <?php } ?>
			</td>
		</tr>

		<?php if ($currentRecord == $count) {
//	This is the last record, display grouping total and close out table
//print '<h1>' . $totalSectionTime . '</h1>';
if($totalSectionTime < 0 || $totalSectionTime > 10000000 || $totalSectionTime == "" || is_null($totalSectionTime)){
	$totalSectionTime = '0:00';
}
else{
	$totalSectionTime = timeDifHoursMinsFromSec($totalSectionTime);
}

print '<tr class="searchHeaderRow"><td colspan="4"> <b>Total Time </b></td><td><b>' . $totalSectionTime . '</td><td></td><td></td></tr>';
		?>
	</table>
</div>
<?php
}
		
		
$currentRecord += 1;
}

}

}
?>