<?php

/**
* This is the description for the class below.
*
* @author     John Seplak
* @version    0.1
*/
class job{

var $dbID;  //  job ID that was set in the database
var $locationId; //database ID for location object
var $employeeId; //database ID for employee object
var $startTime;  // string value of start date in following format: 2012-07-04 12:56:58
var $endTime;   // string value of start date in following format: 2012-07-04 12:56:58
var $employeeLastName;     //  Optional notes to be assocaited with a job
var $employeeFullName;
var $locationName;
var $comments;
var $longitudeStart;
var $LatitudeStart;
var $longitudeEnd;
var $LatitudeEnd;
var $hourlyRate;
var $isPaid;
var $lastUpdated;   //  Time stamp of when this job was last updated. 

function getDBID(){
    return $this->dbID;
}

function setDBID($value){
    $this->dbID = $value;
}

function getLocationId(){
    return $this->locationId;
}

function setLocationId($value){
    $this->locationId = $value;
}

function getEmployeeId(){
    return $this->employeeId;
}

function setEmployeeId($value){
    $this->employeeId = $value;
}

function getStartTime(){
    return $this->startTime;
}

function setStartTime($value){
    $this->startTime = $value;
}

function getDisplayStartTime(){
    return formatStandardDate($this->startTime);
    
}

function getStartDateLong(){
    return formatToMonthDDYYY($this->startTime);
}

function getEndTime(){
    return $this->endTime;
}

function setEndTime($value){
    $this->endTime = $value;
}

function getDisplayEndTime(){
    if($this->endTime=='0000-00-00 00:00:00' || $this->endTime == ''){
        return 'N/A';
    }
    else{
       return formatStandardDate($this->endTime); 
    }
    
}

function totalSeconds(){
    if($this->endTime==''||  is_null($this->endTime)){
        return 0;
    }
    else{
        return timeDiffInSeconds($this->startTime, $this->endTime);
    }
    
}

function getEmployeeLastName(){
    return $this->employeeLastName;
}

function setEmployeeLastName($value){
    $this->employeeLastName = $value;
}

function getEmployeeFullName(){
    return $this->employeeFullName;
}

function setEmployeeFullName($value){
    $this->employeeFullName = $value;
}

function getLocationName(){
    return $this->locationName;
}

function setLocationName($value){
    $this->locationName = $value;
}

function getDatePickerStartDate(){    
    $theDate =  date("n/j/Y", strtotime($this->startTime));
    return $theDate;
}

function getDatePickerEndDate(){
    if($this->endTime==''||$this->endTime=='0000-00-00 00:00:00'){
        return '';
    }
    else{
        $theDate =  date("n/j/Y", strtotime($this->endTime));
        return $theDate;   
    }
    
}

function getComments(){
    return $this->comments;
}

function setComments($value){
    $this->comments = $value;
}

function getLattitudeStart(){
    return $this->LatitudeStart;
}

function setLattitudeStart($value){
    $this->LatitudeStart = $value;
}

function getLongitudeStart(){
    return $this->longitudeStart;
}

function setLongitudeStart($value){
    $this->longitudeStart = $value;
}

function getLattitudeEnd(){
    return $this->LatitudeEnd;
}

function setLattitudeEnd($value){
    $this->LatitudeEnd = $value;
}

function getLongitudeEnd(){
    return $this->longitudeEnd;
}

function setLongitudeEnd($value){
    $this->longitudeEnd = $value;
}

function getGoogleMapsLinkStart(){
    return 'http://maps.google.com/?q=' . $this->LatitudeStart . ',' . $this->longitudeStart;
}

function getGoogleMapsLinkEnd(){
    return 'http://maps.google.com/?q=' . $this->LatitudeEnd . ',' . $this->longitudeEnd;
}

function getHourlyRate(){
    return $this->hourlyRate;
}

function setHourlyRate($value){
    $this->hourlyRate = $value;
}

function getIsPaid(){
    return $this->isPaid;
}

function setIsPaid($value){
    $this->isPaid = $value;
}

function getStartTimeHrMinArray(){
    $time = array();
    $time[0] = date("g", strtotime($this->getStartTime()));
    $time[1] = date("i", strtotime($this->getStartTime()));
    $time[2] = date("A", strtotime($this->getStartTime()));
    return $time;
    
    
}

function getEndTimeHrMinArray(){
    $time = array();
    $time[0] = date("g", strtotime($this->endTime));
    $time[1] = date("i", strtotime($this->endTime));
    $time[2] = date("A", strtotime($this->endTime));
    return $time;
    
    
}







/** This function has no parms or return.
 * This function is only to be used when employee is scanning bar code.
 * It will set the start time to the current server time in the following format:
 * 2012-07-04 12:56:58
 */
function logStartTime(){
    //  Set time zone from globals.php file
    date_default_timezone_set ($GLOBALS['timeZone']);
    $this->startTime = date("Y-m-d H:i:s"); 
}

/** This function has no parms or return.
 * This function is only to be used when employee is scanning bar code.
 * It will set the end time to the current server time in the follow format:
 * 2012-07-04 12:56:58
 */
function logEndTime(){
    date_default_timezone_set ($GLOBALS['timeZone']);
    $this->endTime = date("Y-m-d H:i:s"); //
}

function setStartTimeNow(){
    date_default_timezone_set ($GLOBALS['timeZone']);
    $this->startTime = date("Y-m-d H:i:s"); //
}
/**
 * This function will retrun a formatted time value of the 
 * duration in the following format:  09:55
 * compare the start time and end time
 * and calculate the amount of time spent at the location
 */
function getDuration(){
    
    //  Check to see if the start time and endtime are set
    if(isset($this->startTime)&& isset($this->endTime)){
        
        if($this->endTime=='0000-00-00 00:00:00'){
            return "--:--";
        }
        else{
            //  Calculate the time difference
            return timeDifHoursMins($this->startTime, $this->endTime, $GLOBALS['maxJobTime']);
        }
        
    }
    else{
        //  There aren't two dates to compare return blank value
        return "--:--";
    }
}


}
?>