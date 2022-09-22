<?php


/**
 * This fuction will calculate the difference between two times 
 * in the following format: 2012-07-04 12:56:58
 * 
 * @param String $firstTime string date value (earlier value)
 * @param String $lastTime string date value (later value)
 * @return integer number of seconds in time difference
 */
function timeDiffInSeconds($firstTime,$lastTime){

    // convert to unix timestamps
    $firstTime=strtotime($firstTime);
    $lastTime=strtotime($lastTime);

    // perform subtraction to get the difference (in seconds) between times
    $timeDiff=$lastTime-$firstTime;

    // return the difference
    return $timeDiff;
}

/**
 * This fuction take two dates as string values in the following format: 2012-07-04 12:56:58
 * The time difference will be calculated using the timeDiffInSeconds() function
 *
 * @param String $firstTime string date value (earlier value)
 * @param String $lastTime string date value (later value)
 * @param Integer $maxHours max hours that will be calculated
 * @return String A string value that looks like this: 12:05
 */
function timeDifHoursMins($firstTime,$lastTime,$maxHours){
    
    //  Get the time difference in seconds
    $timeDifference = timeDiffInSeconds($firstTime, $lastTime);
    
    if($timeDifference>0){
        $seconds = $timeDifference%60;            
        $minutes = (($timeDifference%3600)-$seconds)/60;

        //  Round off is seconds add up to half a minute
        if($seconds>30){
            $minutes+=1;
        }

        //  Concatenate leading zero if needed
        if($minutes<10){
            $minutes = '0' . $minutes;
        } 
        
        //  Calculate Number of hours
        $hours = ($timeDifference -($timeDifference%3600))/3600;
        
        if($hours<$maxHours){
            //  Return string value of amount of time
            return $hours . ":" . $minutes;
        }
        else{
            //  Retrun a message stating that amount of hours is greater than maxhours
            return "> " . $maxHours . " hours";
        }        
    }
    else{
        //  The dates compared return a negitive number
        return 'error';
    }

}

function timeDifHoursMinsFromSec($timeDifference){
    
    //  Get the time difference in seconds
    
    
    if($timeDifference>0){
        $seconds = $timeDifference%60;            
        $minutes = (($timeDifference%3600)-$seconds)/60;

        //  Round off is seconds add up to half a minute
        if($seconds>30){
            $minutes+=1;
        }

        //  Concatenate leading zero if needed
        if($minutes<10){
            $minutes = '0' . $minutes;
        } 
        
        //  Calculate Number of hours
        $hours = ($timeDifference -($timeDifference%3600))/3600;
        
        
            //  Return string value of amount of time
            return $hours . ":" . $minutes;
       
              
    }
    else{
        //  The dates compared return a negitive number
        return 'error';
    }

}

/**
 * This fuction take two dates as string values in the following format: 2012-07-04 12:56:58
 * The time difference will be calculated using the timeDiffInSeconds() function

 * @param String $firstTime string date value (earlier value)
 * @param String $lastTime string date value (later value)
 * @param Integer $maxHours max hours that will be calculated
 * @return String A string value that looks like this: 12:05:55
 */
function timeDifHoursMinsSeconds($firstTime,$lastTime,$maxHours){
    
    //  Get the time difference in seconds
    $timeDifference = timeDiffInSeconds($firstTime, $lastTime);
    
    if($timeDifference>0){
        $seconds = $timeDifference%60;            
        $minutes = (($timeDifference%3600)-$seconds)/60;

        //  Round off is seconds add up to half a minute
        if($seconds<10){
            $seconds = "0" . $seconds;
        }

        //  Concatenate leading zero if needed
        if($minutes<10){
            $minutes = '0' . $minutes;
        } 
        
        //  Calculate Number of hours
        $hours = ($timeDifference -($timeDifference%3600))/3600;
        
        if($hours<$maxHours){
            //  Return string value of amount of time
            return $hours . ":" . $minutes . ":" . $seconds;
        }
        else{
            //  Retrun a message stating that amount of hours is greater than maxhours
            return "> " . $maxHours . " hours";
        }        
    }
    else{
        //  The dates compared return a negitive number
        return 'error';
    }

}

function getCurrentDateTime(){
    date_default_timezone_set ($GLOBALS['timeZone']);
    $currentDateTime =  date("F j, Y, g:i a");
    return $currentDateTime;
}

function oneDayAgo(){
    date_default_timezone_set ($GLOBALS['timeZone']);
    $oneDayAgo =  time() - (24 * 60 * 60);
    return date('Y-m-d H:i:s', $oneDayAgo);
}

function oneWeekAgo(){
    date_default_timezone_set ($GLOBALS['timeZone']);
    $oneWeekAgo =  time() - (24 * 60 * 60 * 7);
    return date('Y-m-d H:i:s', $oneWeekAgo);
}

function formatStandardDate($dateTime){
    $theTime=strtotime($dateTime);
    return date("F j, Y",$theTime). " <br /> " . date("g:i a",$theTime); 
}

function formatToMonthDDYYY($dateTime){
    $theTime=strtotime($dateTime);
    return date("F j, Y",$theTime); 
}

function formatMMDDYYY_toTimeStamp($theDate,$addDay){
	
	$dates = explode("/", $theDate);
	$month = $dates[0];
	$day = $dates[1];
	$year = $dates[2];
    
    $offsetDay = $day + $addDay;
    return date("Y-m-d H:i:s",mktime(0, 0, 0, $month,$offsetDay , $year)); 
}


?>