<?php
// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (!isset($_SESSION['userName'])) {
header('Location: index.php');
}



require '../php/globals.php';


$title = 'Longo Corporation - Logged In';
$description = 'This is the description';
$keywords = 'These are the keywords';

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
                    Welcome <?php print $_SESSION['employeeName'];?>
                </h3>
                <br />
                <br />
                <p>
                     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus semper laoreet nibh id pellentesque. Fusce condimentum auctor enim, eu placerat lacus fermentum eu. Aenean dictum imperdiet odio. Nulla sit amet ante nec quam tempus aliquet eget sit amet lectus. Curabitur quis metus nibh. Fusce egestas nisl faucibus nisl convallis imperdiet. Praesent facilisis nisi odio. Fusce interdum elit lectus, eu rhoncus ligula. Fusce id nibh sem. Vestibulum vestibulum dignissim ligula sit amet gravida. Duis lobortis, est varius sollicitudin porta, ligula sapien molestie neque, eget tincidunt tellus massa ut velit. Fusce sed commodo dui. Nullam vitae sollicitudin turpis.
                </p>
                <br />
                <p>
Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean vel vulputate ante. Mauris imperdiet, ligula et semper auctor, quam dolor aliquam mauris, vitae lobortis urna est eget odio. Ut in consequat erat. Aliquam ornare, augue a consequat gravida, erat ante pulvinar velit, id eleifend est nisl vitae ante. Cras auctor rutrum tempor. Ut condimentum euismod est, sit amet malesuada est suscipit id. 
                </p>

               <?php
                $randomString = get_random_string(10);
                print $randomString;
               ?>

                
                
           </div>
            <div class="clear"></div>
        </div>
    </div>  
</section> 

<?php printFooter();?>