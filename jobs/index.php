<?php
/**
 * Created by Mustafeez Ali (mtfz@msn.com).
 * Date: 5/2/2017
 * Time: 6:39 PM
 */

include_once "header.php";

// Check, if user is already login, then jump to secured page
if ( ! isset( $_SESSION['userName'] ) ) {
    echo "<script>window.open('".$baseLoc . "/jobs/login.php','_self')</script>";
	//header( 'Location: ' . $baseLoc . "/jobs/login.php" );
}
else if ( $_SESSION['userRole'] == 'admin' || $_SESSION['userRole'] == 'employee'  ) {
	//header( 'Location: ' . $baseLoc . "/admin/" );
	echo "<script>window.open('".$baseLoc . "/admin/','_self')</script>";
}
$userRole = $_SESSION['userRole'];
$disabled = 'disabled="disabled"';
if($userRole == "cadmin"){
	$disabled = '';
}
?>
<section id="content">
    <div class="container_12"></div>
    <div class="aside">
        <!--<div class="container-fluid">-->
        <div class="container_12">
            <div class="buttons-right-top">
                <a href="" class="contact-longo" data-toggle="modal" data-target="#contact-longo">Contact Longo <img
                            src="<?php echo $baseLoc ?>/images/contact.png"></a>
                <a href="" class="add-job" data-toggle="modal" data-target="#add-job">Add Job <img src="<?php echo $baseLoc ?>/images/plus.png"></a>
            </div>
            <div class="main-table-page" style="overflow-x:auto;">
                <table id="jobsListTbl" class="tablesorter">
                    <thead>
                    <tr>
                        <th>Yard</th>
                        <th>Building / Location</th>
                        <th>Job description</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Contact phone</th>
                        <th>Contact email</th>
                        <th>Status</th>
                        <th>Estimate</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="bodyLoading"><img src="<?php echo $baseLoc ?>/images/throbber_13.gif" alt="loading"></div>
            </div>
        </div>
    </div>
</section>
<?php
//printFooter();
include_once "footer.php";
include_once "../plego/light_boxes.php";
?>


