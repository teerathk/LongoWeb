<?php

// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])) {
header('Location: ../admin');
}
include 'functions/dates.php';

$searchParameters = '';
$locationId = $_POST['locations'];
$employeeId = $_POST['employees'];
$startDate = $_POST['startDate'];
$paidStatus = $_POST['paid'];
if($startDate!=''){
    $timestamp_start = formatMMDDYYY_toTimeStamp($startDate,0);
}
$endDate = $_POST['EndDate'];
if($endDate!=''){
   $timestamp_end = formatMMDDYYY_toTimeStamp($endDate,1); 
}

$sortBy = $_POST['sort'];

if($locationId!='all'){
    $searchParameters = ' AND jobs.locationId = ' . $locationId;
}

if($paidStatus!='all'){
    $searchParameters .= ' AND jobs.paid = ' . $paidStatus;
}

if($employeeId!='all' && isset($employeeId)){
    if($searchParameters==''){
        $searchParameters = ' AND jobs.employeeId = ' . $employeeId;
    }
    else{
        $searchParameters .= ' AND jobs.employeeId = ' . $employeeId;
    }
}
elseif($_SESSION['userRole']!='admin'){
	
	$searchParameters .= ' AND jobs.employeeId IN (SELECT employees.employeeId FROM employees WHERE username = "' . $_SESSION['userName'] . '")';
}

if($startDate!=''){
    if($searchParameters==''){
        $searchParameters = " AND timestamp_start > '" . $timestamp_start . "'";
    }
    else{
        $searchParameters .= " AND timestamp_start > '" . $timestamp_start . "'";
    }
        
}

if($endDate!=''){
    if($searchParameters==''){
        $searchParameters = " AND timestamp_start < '" . $timestamp_end . "'";
    }
    else{
        $searchParameters .= " AND timestamp_start < '" . $timestamp_end . "'";
    }
}

$searchParameters .= " ORDER BY " . $sortBy; 
if($sortBy != 'timestamp_start DESC'){
    $searchParameters .= ', timestamp_start DESC;';
}

$_SESSION['searchParam'] = $searchParameters;
$_SESSION['locationSelection'] = $locationId;
$_SESSION['employeeSelection'] = $employeeId;
$_SESSION['startDateSelection'] = $startDate;
$_SESSION['endDateSelection'] = $endDate;
$_SESSION['sortSelection'] = $sortBy;
$_SESSION['paid'] = $paidStatus;



header('Location: ../admin/manageJobs.php');

    

/*
 * Validate Dates
 * Verify that both date values are actuall dates
 * Make sure both dates are in the future
 * Make sure that Start Date is before End Date
 * 
 * if bad date, set error message to session
 * set values to session, so that form will be repopulated
 */

/*
 * Each parameter should have it's own processing
 * parms concatenated while processing each field
 * if field is all, a parameter will not be added
 */

/*
 * When all validation and processing has been done,
 * set query to session, and execute query from the form page]
 * Don't forget to unset the session variables
 */
?>
