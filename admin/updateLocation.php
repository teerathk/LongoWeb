<?php

// Inialize session
if($_COOKIE['ses_id']){
    session_id($_COOKIE['ses_id']);
}
session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])) {
header('Location: index.php');
}

require '../php/globals.php';

$locationNumber = '';
$locationName = '';
$currentLocationId = '';

if(isset($_GET['locationId']) && $_GET['locationId']=='new'){
   $newLocation = TRUE;
   $pageTitle = 'Add new location';
   $buttonTitle = 'Add Location';
   $currentLocationId = $_GET['locationId'];
}
elseif(isset($_SESSION['updateLocation'])){
    if($_SESSION['updateLocation']['currentLocationId']=='new'){
        
        $newLocation = TRUE;
        $pageTitle = 'Add new location';
        $buttonTitle = 'Add Location';
        
    }
    else{
        $newLocation = FALSE;
        $pageTitle = 'Update Location Information';
        $buttonTitle = 'Update Location';
        
    }
    $currentLocationId = $_SESSION['updateLocation']['currentLocationId'];
    $locationName = $_SESSION['updateLocation']['locationName'];
    $locationNumber = $_SESSION['updateLocation']['locationNumber'];
    
    
}
else{
    $newLocation = FALSE;
    $pageTitle = 'Update Location Information';
    $buttonTitle = 'Update Location';
    $dbLocation = new locationDB();
    $theLocation = new location();
    $theLocation = $dbLocation->getLocationById($_GET['locationId']);
    $locationName = $theLocation->getName();
    $currentLocationId = $theLocation->getDBID();
    $locationNumber = $theLocation->getDBID();
    
}


//  




$title = 'Longo Corporation - Change Password';
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
               
            <div class="grid_12">
                <h3>
                    <?php print $pageTitle;?>
                </h3>
                <br />
                <p>
                    Please enter the information below.
                </p>

                <br />
 <form action="../php/updateLocation.php" method="post" name="updateLocation" id="updateLocation">
     <input type="hidden" name="currentLocationID" value="<?php print $currentLocationId;?>" />
                        <fieldset>
                            <label>Location Number</label>
                            <br />
                            <?php 
                                if(isset($_SESSION['updateLocation']['errors']['locationNumber'])){
                                    print '<p class="errorMessage">' . $_SESSION['updateLocation']['errors']['locationNumber'] . '</p>';
                                }
                            ?>
                            
                            <input type="text"  name="locationNumber" value="<?php print $locationNumber;?>" size="35" maxlength="4">
                            <br />
                            
<label>Location Name</label>
                            <?php 
                                if(isset($_SESSION['updateLocation']['errors']['locationName'])){
                                    print '<p class="errorMessage">' . $_SESSION['updateLocation']['errors']['locationName'] . '</p>';
                                }
                            ?>
                            <br />
                            <input type="text"  name="locationName" value="<?php print $locationName;?>" size="35" maxlength="30">                            
                            
                            
                            
                            
                            
                            
                            
                            

                            <div class="btns">
                            	<input type="submit" value="<?php print $buttonTitle;?>" class="button">
                                <a class="button" href="manageLocations.php">
                                   Cancel
                                </a>

                            </div>
                            
                        </fieldset>  
                    </form>   
                
               
                                               <br />
                               <br />
                               <br />
                               <br />
                               <br />
                               

                
                
           </div>
            <div class="clear"></div>
        </div>
    </div>  
</section> 
<?php unset($_SESSION['updateLocation']);?>
<?php printFooter();?>

