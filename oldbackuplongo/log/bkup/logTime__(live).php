<?php
if($_COOKIE['ses_id']){
    session_id($_COOKIE['ses_id']);
}
session_start();
$_SESSION['userContext'] = 'log';
if(!isset($_SESSION['userName'])){
    header('Location: signIn.php');
}
elseif(!isset ($_SESSION['pass'])|| !isset ($_SESSION['location']) || $_SESSION['pass']!=TRUE){
    
    header('Location: index.php');
}
else{
require '../php/globals.php';
$dbLocation = new locationDB();
$locationName = $dbLocation->getLocationName($_SESSION['location']);

$dbJobs = new jobDB();
$theJobs = new jobs();
$aJob = new job();
$theJobs = $dbJobs->getOpenJobsEmployeeLocation($_SESSION['userId'],$_SESSION['location']);
$openJobs = $theJobs->getCount();
$jobDdId = "";

if($openJobs == 0){
    $aJob->setEmployeeId($_SESSION['userId']);
    $aJob->setLocationId($_SESSION['location']);
    $aJob->logStartTime();
    $dbJobs->addJob($aJob);
    $action = 'New';
    
}
else{
    $aJob = $theJobs->getFirstIndexJob();
    $aJob->logEndTime();
    $dbJobs->updateJob($aJob);
    $action = 'update';
}

    // Get lattitude and longitude for either start or end of a job scan
    if($action=='update'){
        $jobDdId = $aJob->getDBID();
        // add code for javascript json to update the database
    }
    elseif ($action=='New') {
        $theJobs = $dbJobs->getOpenJobsEmployeeLocation($_SESSION['userId'],$_SESSION['location']);
        $aJob = $theJobs->getFirstIndexJob();
        $jobDdId = $aJob->getDBID();
    }

unset($_SESSION['location']);
unset($_SESSION['pass']);
}






$title = 'Longo Corporation - Log Start/Stop Time';
$description = '';
$keywords = '';

printHeadLog($title, $description, $keywords);
printHeaderLog();
?>

<!--==============================content================================-->
<script src="../js/jquery.js"></script>
<script>


    $(document).ready(function() {
        var latitude;
        var longitude;
        var action = "<?php print $action; ?>";
        var jobId = "<?php print $jobDdId; ?>";
            navigator.geolocation.getCurrentPosition(function(position) {
                
            latitude = position.coords.latitude;            
            longitude = position.coords.longitude;
            $.post('../php/updateGPs.php', {action: action, jobId: jobId, latitude: latitude, longitude: longitude}, 
    function(returnedData){
        
         console.log(returnedData);
        });
        
        
},geoError);

 var geoError = function(error) {
    console.log('Error occurred. Error code: ' + error.code);
    alert('Error occurred. Error code: ' + error.code);
    // error.code can be:
    //   0: unknown error
    //   1: permission denied
    //   2: position unavailable (error response from location provider)
    //   3: timed out
  };
        
 });       
        
   

               
                
                
   



</script>
<section id="content">
    <div class="container_12">

    </div>
    <div class="aside">
        <div class="container_12">	
            <div class="grid_12">
                <h2>
                <?php
                    if($action=='New'){
                        print 'Start Time Logged';
                    }
                    else{
                        print 'End Time Logged';
                    }
                ?>
                </h2>
                
                <p>
                    
                </p>
                    <b>Employee Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <?php print $_SESSION['employeeName'];?>
                <p>
                    <b>Location Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <?php print $locationName;?>
                </p>
                <p>
                    <b>Start Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <?php print $aJob->getDisplayStartTime();?>
                </p>
                <p>
                    <b>End Time:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?php 
                        if($action=='update'){
                            print $aJob->getDisplayEndTime();
                            print '</p>';
                            print '<p><b>Total Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>';
                            print $aJob->getDuration();
                            
                        }
                        else{
                            print 'N/A';
                        }
                    ?>
                </p>
                <br />
                <a href="../admin/" class="button">View Time Logs</a>
                <br />
                <br />
                <a href="../php/logout.php?context=admin" class="button">
                    Log Out
                </a>
           </div>
            <div class="clear"></div>
        </div>
    </div>  
</section> 


<?php printFooter();?>