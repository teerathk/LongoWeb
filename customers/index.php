<?php
/**
 * Created by Mustafeez Ali (mtfz@msn.com).
 * Date: 5/2/2017
 * Time: 6:39 PM
 */

include_once "header.php";

// Check, if user is already login, then jump to secured page
if ( ! isset( $_SESSION['userName'] ) ) {
	//header( 'Location: ' . $baseLoc . "/admin/" );
	echo "<script>window.open('".$baseLoc . "/admin/','_self')</script>";
}
else if ( $_SESSION['userRole'] != 'admin'  ) {
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
            <h3>Manage Customers</h3>
            <div class="buttons-left-top">
                <a href="" class="contact-longo" id="addCustomerBtn" data-toggle="modal" data-target="#add-customer">Add Customer
                    <img src="<?php echo $baseLoc ?>/images/plus.png"></a>
            </div>
            <div class="main-table-page center-td" style="overflow-x:auto;">
                <table id="customersListTbl" class="tablesorter">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
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




