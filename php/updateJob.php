<?php

// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])) {
	header('Location: index.php');
}
if (isset($_GET['delid'])) {
	require_once 'globals.php';
	$dbJobs = new jobDB();
	$dbJobs -> deleteJob($_GET['delid']);
	header('Location: ../admin/manageJobs.php');

} else {
        if(isset($_POST['paid'])){
            $paid = 1;
        }
        else{
            $paid = 0;
        }
        $comments = htmlentities($_POST['comments']);
	$startDate = $_POST['startDate'];

	$startDateArray = explode("/", $startDate);
	$startMonth = $startDateArray[0];
	$startDay = $startDateArray[1];
	$startYear = $startDateArray[2];
	$startMin = $_POST['startMinute'];

	$startHour = $_POST['startHour'];
	$startAmpm = $_POST['startAmpm'];
	if ($startAmpm == 'PM' && $startHour < 12) {
		$startHour = $startHour + 12;
	} 
        
        if ($startAmpm == 'AM' && $startHour == 12) {
		$startHour = '0';
	}
	if ($startHour < 10) {
		$startHour = "0" . $startHour;
	}

	if ($startMonth < 10) {
		$startMonth = "0" . $startMonth;
	}

	if ($startMin < 10) {
		$startMin = "0" . $startMin;
	}

	if($_POST['jobId']=='xxx'){
		$theStartDate = '' . $startYear . '-' . $startMonth . '-' . $startDay . ' ' . $startHour . ':' . $startMin . ':00';
	}
else{
	$theStartDate = '"' . $startYear . '-' . $startMonth . '-' . $startDay . ' ' . $startHour . ':' . $startMin . ':00"';
}
	

	$endDate = $_POST['endDate'];
	if (!isset($_POST['excludeEndTime'])) {// test to see if check box is checked
		$endDateArray = explode("/", $endDate);
		$endMonth = $endDateArray[0];
		$endDay = $endDateArray[1];
		$endYear = $endDateArray[2];
		$endMin = $_POST['endMinute'];

		$endHour = $_POST['endHour'];
		$endAmpm = $_POST['endAmpm'];
		if ($endAmpm == 'PM') {
			
				$endHour = $endHour + 12;
			
			
		}
		if ($endHour == 12) {
			$endHour = 0;
		}
		if ($endHour == 24){
			$endHour = 12;
		}
		if ($endHour < 10) {
			$endHour = "0" . $endHour;
		}

		if ($endMonth < 10) {
			$endMonth = "0" . $endMonth;
		}

		if ($endMin < 10) {
			$endMin = "0" . $endMin;
		}


if($_POST['jobId']=='xxx'){
	$theEndDate = '' . $endYear . '-' . $endMonth . '-' . $endDay . ' ' . $endHour . ':' . $endMin . ':00';
}
else{
	$theEndDate = '"' . $endYear . '-' . $endMonth . '-' . $endDay . ' ' . $endHour . ':' . $endMin . ':00"';
}
		

	} else {
		$theEndDate = '""';
	}

	include_once 'globals.php';
	$jobId = $_POST['jobId'];
	$dbJobs = new jobDB();

	if($_POST['jobId'] == 'xxx'){
		$theJob = new job;
		$theJob->setStartTime($theStartDate);
		$theJob->setEndTime($theEndDate);
		$theJob->setEmployeeId($_POST['employees']);
		$theJob->setLocationId($_POST['locations']);
                $theJob->setIsPaid($paid);
                $theJob->setComments($_POST['comments']);
                
		//	get employee and location id
			$dbJobs -> addJob($theJob);
	}
	else{
		$dbJobs -> udateJobTimes($paid, $comments, $theStartDate, $theEndDate, $jobId);
	}
	

	$_SESSION['updatedJobMessage'] = 'The job has been updated';

	header('Location: ../admin/manageJobs.php');
}
?>
