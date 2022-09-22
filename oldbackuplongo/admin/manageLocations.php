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

$dbLocations = new locationDB();

$allLocations = new locations();
$allLocations = $dbLocations->getAllLocations();


$title = 'Longo Corporation - Manage Users';
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
                    Manage Locations
                </h3>
                <br />
                
                <a class="button" href="updateLocation.php?locationId=new"> Add New Location </a>
                <br />
                <br />
              <?php
                $allLocations->printLocationList();
              ?>

                
                
           </div>
            <div class="clear"></div>
        </div>
    </div>  
</section> 

<?php printFooter();?>