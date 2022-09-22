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


$title = 'Longo Corporation - Add New Job';
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

                <h3>
                   <?php
                   		if($_SESSION['userRole']=='admin'){
                   			print 'Add New Job';
                   		}
					
						?> 
                </h3>
                
                <br />
                

                
               <h2>
               		Page Coming Soon
               </h2>

                
                
         
            <div class="clear"></div>
        </div>
    </div>  
</section> 

<?php printFooter();?>