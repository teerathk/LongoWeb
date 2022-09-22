<?php
/**
 * Thic fuction takes in a string and a high and low value and 
 * checks the string to see if the number of characters is within
 * the high and low range and retruns true if within range
 * 
 * @param Integer $low
 * @param Integer $high
 * @param String $field
 * @return Boolean True if within range
 */
function checkNumCharactersRange($low, $high,$field){
    
}

/**
 * This function will check for a valid email address
 * and return true if valid email address
 * 
 * @param type $emailAddress
 * @return Boolean True if valid email
 */
function validateEmail($emailAddress){
    
        //  Check to see if there are more than two periods in email address
    	$pieces = explode(".", $emailAddress);
	if(count($pieces)>3){
		return FALSE;
	}
//        
//        
//        if(preg_match("/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $emailAddress) > 0)
//        {
//          return TRUE;
//        }
//        else
//        {
//          return FALSE;
//        }
    if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
}
}

/**
 * 
 * @param type $str_to_test Strint to test for characters
 * @param type $bad_strings Array of bad values to test for
 * @return type Description
 */
function check_for_malicious_injection($str_to_test,$bad_strings) {
	

	foreach ($bad_strings as $bad_string) {
		if (stristr(strtolower($str_to_test),$bad_string )) {
			return FALSE;
		}
		else{
			$pos = strpos($str_to_test, "http");
			$pos2 = strpos($str_to_test, "a href=");
			$pos3 = strpos($str_to_test, "url=");
			$pos3 = strpos($str_to_test, "</a>");
			if($pos==TRUE||$pos2==TRUE||$pos3==TRUE){
				echo " Please do not use hyperlinks in the form submitted. - mail not being sent.";
			return FALSE ;
			}
		}
                      return TRUE;
		
	}
}

function contains_bad_str($str_to_test) {
	$bad_strings = array("content-type:", "mime-version:", "multipart/mixed", "Content-Transfer-Encoding:", "bcc:", "cc:", "</a>", "<a href=",  "to:", "http://", "url=", "123456", "teennynex","<?ph", "");

	foreach ($bad_strings as $bad_string) {
		if (stristr($bad_string, strtolower($str_to_test))) {
			echo " Suspected injection attempt - mail not being sent.";
			footer();
			exit ;
		}
		else{
			$pos = strpos($str_to_test, "http");
			$pos2 = strpos($str_to_test, "a href=");
			$pos3 = strpos($str_to_test, "url=");
			$pos3 = strpos($str_to_test, "</a>");
			if($pos==TRUE||$pos2==TRUE||$pos3==TRUE){
				echo " Please do not use hyperlinks in the form submitted. - mail not being sent.";
			footer();
			exit ;
			}
		}
		
	}
}

/**
 * 
 * @param String $number
 * @return Boolean True if is number
 */
function validateNumber($number){
    
}

/**
 * 
 * @param type $phoneNumber
 * @return Boolean Retrun True if valid phone number
 */
function validatePhoneNumber($phoneNumber){
    
}
?>
