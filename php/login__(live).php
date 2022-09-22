<?php
session_start();

if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"apple")) //to prevent cookies for non-apple devices
{
    $cookieLifetime = 16 * 60 * 60; // Set cookie lifetime to 16 hours
    setcookie("ses_id",session_id(),time()+$cookieLifetime);
}

require ('../php/globals.php');
$ipAddress = getIP();
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$userId = "";
if(isset($_SESSION['userId'])){
   $userId = $_SESSION['userId']; 
}

$userName = "";
$success = 0;
$sessionId = getSessionId();

function redirectToLogInFail() {

	$_SESSION['tmpUserName'] = trim($_POST['userName']);
	$_SESSION['tmpPassword'] = trim($_POST['password']);

	if ($_SESSION['userContext'] == 'admin') {
		
		//	Send user back to the admin login page to try to log in again
		header('Location: ../admin/index.php?loginFailed');
	} else if ($_SESSION['userContext'] == 'log') {
		
		//	Send user back to log page to try to log in again
		header('Location: ../log/signIn.php?loginFailed');
	}
}

//  Validate user input
$badCharsArray = array(">", "<", "<?", ";", "|", );
$hasErrors = FALSE;
$newUser = FALSE;

//	Check to see if this is a new user based off of password
if (stristr(strtolower($_POST['password']), '3A3') || $_POST['password'] == "abc123") {
	$newUser = TRUE;
}

//	Validate user input for user name
if (isset($_POST['userName'])) {
	$userName = trim($_POST['userName']);
	$noMal = check_for_malicious_injection($userName, $badCharsArray);
	if ($noMal == FALSE) {
		addSessionErrorMessage('You have used an illegal character in user name field.');
		$hasErrors = TRUE;
	}

}

//	Validate user input for password
if (isset($_POST['password'])) {
	$userName = trim($_POST['password']);
	$noMal = check_for_malicious_injection($userName, $badCharsArray);
	if ($noMal == FALSE) {
		addSessionErrorMessage('You have used an illegal character in the password field. ');
		$hasErrors = TRUE;
	}
}

if ($hasErrors == TRUE) {
    logLogin($userId, $userName, $sessionId, $ipAddress, $userAgent, $success);
	redirectToLogInFail();
} else {
	$dbEmployee = new employeeDB();
	$logInEmployee = $dbEmployee -> getEmployeeByLogIn(trim($_POST['userName']), trim($_POST['password']));
	$userName = $logInEmployee -> getUserName();
	if ($userName) {
		
		//	User has logged in successfully
		userToSession($logInEmployee);
                $userId = $_SESSION['userId'];
                $userName = $_SESSION['userName'];
                $success = 1;
                
                logLogin($userId, $userName, $sessionId, $ipAddress, $userAgent, $success);

		if (isset($_SESSION['tmpPassword'])) {
			unset($_SESSION['tmpPassword']);
		}
		if (isset($_SESSION['tmpUserName'])) {
			unset($_SESSION['tmpUserName']);
		}
                
                

		if ($newUser == TRUE) {
			$_SESSION['updatePassword'] = TRUE;
			
			//	Send user to prompt to change their password
			header('Location: ../admin/changePassword.php');
		} elseif ($_SESSION['userContext'] == 'admin') {
				
			//	Send user to the admin panel
			header('Location: ../admin/manageJobs.php');
		} elseif ($_SESSION['userContext'] == 'log') {
				
			//	Send user back to log page to log their time
			header('Location: ../log/logTime.php');
		}
	} else {

		//	User Match not found
                logLogin($userId, $userName, $sessionId, $ipAddress, $userAgent, $success);
		addSessionErrorMessage('No match found please try again');
		redirectToLogInFail();
	}
}
?>
