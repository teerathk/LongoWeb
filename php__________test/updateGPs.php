<?phprequire '../php/globals.php';if(isset($_POST['action'])){    $latitude = $_POST['latitude'];    $longitude = $_POST['longitude'];    $dbid = $_POST['jobId'];    $dbJobs = new jobDB();    $theJobs = new jobs();    $aJob = new job();    $aJob->setDBID($dbJobs);    if($_POST['action']=="New"){                $dbJobs->updateStartCoordinates($dbid, $latitude, $longitude);                //$dbJobs->updateStartLocation($dbid, $latitude, $longitude);            }elseif($_POST['action']=="update"){                        $dbJobs->updateEndCoordinates($dbid, $latitude, $longitude);                //$dbJobs->updateEndLocation($dbid, $latitude, $longitude);    }}if(isset($_POST['error'])){        $dbid = $_POST['jobId'];    $dbJobs = new jobDB();        if($_POST['error']=="New"){               $dbJobs->updateErrorLocation($dbid, "start_location", $_POST['error']);                    }    elseif($_POST['error']=="update"){                        $dbJobs->updateErrorLocation($dbid, "end_location", $_POST['error']);                    }}?>