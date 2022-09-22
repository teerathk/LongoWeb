<?php
/**
 * Created by Mustafeez Ali (mtfz@msn.com).
 * Date: 5/2/2017
 * Time: 9:57 PM
 */

// Inialize session
session_start();

$baseProto = isset( $_SERVER['HTTPS'] ) ? "https://" : "http://";
$baseHost  = $_SERVER['HTTP_HOST'];
$baseURI   = $_SERVER['REQUEST_URI'];
$baseLoc   = $baseProto . $baseHost;

$cpActive = '' ;
if($baseURI == '/customers/' ){
    $cpActive = 'cpActive' ;
}

$userRole = '';
$userId = '';
if ( isset( $_SESSION['userRole'] ) ) {
	$userRole = $_SESSION['userRole'];
	$userId = $_SESSION['userId'];
}

/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Longo Corporation</title>
    <link href="<?php echo $baseLoc ?>/css/reset.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo $baseLoc ?>/css/style.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo $baseLoc ?>/css/grid_12.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo $baseLoc ?>/css/slider.css" rel="stylesheet" type="text/css" media="screen">

    <link href="<?php echo $baseLoc ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $baseLoc ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $baseLoc ?>/css/tablesorter.css" rel="stylesheet">
    <link href="<?php echo $baseLoc ?>/css/custom-style.css" rel="stylesheet">

    <script src="<?php echo $baseLoc ?>/js/jquery-1.7.min.js"></script>
    <script src="<?php echo $baseLoc ?>/js/jquery.min.js"></script>
    <script src="<?php echo $baseLoc ?>/js/jquery.metadata.js"></script>
    <script src="<?php echo $baseLoc ?>/js/jquery.tablesorter.min.js"></script>
    <style>
        .cpActive {
            background: url(../images/current.jpg) 0 0 repeat-x #000000 !important;
            border-right: #000000 1px solid !important;
            border-left: #000000 1px solid !important;
        }
    </style>

</head>
<body>
<div class="main" data-id="<?php echo $userId ?>" data-ur="<?php echo $userRole ?>">
    <header>
        <div id="logoName">
            <a href="<?php echo $baseLoc ?>"><img src="<?php echo $baseLoc ?>/images/longoLogo.png" class="longoLogo" alt="Longo Corporation Logo"></a>
            <h2 class="longoH1">Longo Corporation<br>
                <span class="subHeading">Facilities Management Services</span>
            </h2>
        </div>
        <div class="clear"></div>

        <nav class="box-shadow">
            <div>
                <ul class="menu">
                    <li><a href="<?php echo $baseLoc ?>/admin/manageJobs.php">Manage Jobs</a></li>
                    <li><a href="<?php echo $baseLoc ?>/admin/manageUsers.php">Manage Users</a></li>
                    <li><a href="<?php echo $baseLoc ?>/admin/manageLocations.php">Manage Locations</a></li>
                    <?php if ($_SESSION['userRole'] === 'admin') {?>
                        <li class="<?php echo $cpActive ?>"><a href="<?php echo $baseLoc ?>/customers/">Manage Customers</a></li>
                    <?php }
                    if ( isset( $_SESSION['userName'] ) ) { ?>
                        <li><a href="<?php echo $baseLoc ?>/php/logout.php">Log out</a></li>
                    <?php } ?>
                </ul>
                <div class="social-icons">
                    <span>Logged in as <?php echo $_SESSION['userName'] ?></span>
                </div>
                <div class="clear"></div>
            </div>
        </nav>
    </header>