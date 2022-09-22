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

if($baseURI == '/jobs/login.php' || $baseURI == '/jobs'){

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
   <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $baseLoc ?>/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $baseLoc ?>/css/sm-core-css.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $baseLoc ?>/css/sm-clean.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $baseLoc ?>/css/navigation.css">
    <link href="<?php echo $baseLoc ?>/css/reset.css" rel="stylesheet" type="text/css" media="screen">
 
    <link href="<?php echo $baseLoc ?>/css/style.css" rel="stylesheet" type="text/css" media="screen">

    <link href="<?php echo $baseLoc ?>/css/grid_12.css" rel="stylesheet" type="text/css" media="screen">

    <link href="<?php echo $baseLoc ?>/css/slider.css" rel="stylesheet" type="text/css" media="screen">


    <link href="<?php echo $baseLoc ?>/css/font-awesome.min.css" rel="stylesheet">

    <link href="<?php echo $baseLoc ?>/css/tablesorter.css" rel="stylesheet">

    <link href="<?php echo $baseLoc ?>/css/custom-style.css" rel="stylesheet">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo $baseLoc ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $baseLoc ?>/js/jquery.smartmenus.js"></script>

    <script src="<?php echo $baseLoc ?>/js/jquery.tablesorter.min.js"></script>
   <script type="text/javascript">
        jQuery(document).ready(function () {
           jQuery('#menu-top-menu').smartmenus({
           subMenusSubOffsetX: 1,
           subMenusSubOffsetY: 0
           });
         });
        
    </script>
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
           <div class="container">
        <div class="row">
            <div class="col-lg-6">
            <a href="https://longocorporation.com/"><img src="<?php echo $baseLoc ?>/images/longoLogo.png" class="longoLogo" alt="Longo Corporation Logo">

            <h2 class="longoH1">Longo Corporation<br>

                <span class="subHeading">Facilities Management Services</span>

            </h2>
</a>
        </div>
        </div>
        </div>
        </div>

        <?php if($baseURI == '/jobs/'){ ?>

            <div id="logoName">

                <!--<a href=""><img src="<?php /*echo $baseLoc */?>/images/<?php /*echo $_SESSION['cLogo'] */?>" class="longoLogo" alt="Customer Logo"></a>-->

                <h2 class="longoH1" style="margin-left: 20px;"><?php echo $_SESSION['cName'] ?><br></h2>

            </div>

        <?php } ?>

        <div class="clear"></div>


    <div class="navigation">
         <nav class="navbar navbar-expand-xl navbar-light main-NaveBar">
               <a class="navbar-brand" href="https://smiss.org"></a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <i class="fa fa-bars" aria-hidden="true"></i>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul id="menu-top-menu" class="sm sm-clean  primeryManu">
                    <li><a href="https://longocorporation.com/"><img src="<?php echo $baseLoc ?>/images/home-page-img.png"></a></li>
                    <li><a href="<?php echo $baseLoc ?>/about.php">About Us</a></li>
                    <li><a href="<?php echo $baseLoc ?>/services.php">Services</a></li>
                    <li><a href="<?php echo $baseLoc ?>/jobs">Customer Portal</a></li>
                     <li><a href="#">Checklist</a>
                      <ul class="sub-menu">
                           <li><a href="<?php echo $baseLoc ?>/checklist.php">Homesite</a></li>
                           <li><a href="<?php echo $baseLoc ?>/skirting.php">Skirting</a></li>
                       </ul>
                    </li>
                    <li><a href="<?php echo $baseLoc ?>/contact.php">Contact Us</a></li>
                  </ul>
                 <div class="social-icons">
                    <span>Follow us:</span>
                    <!--<a href="#" class="icon-3"></a>-->
                    <a href="https://www.facebook.com/LongoCorporation" class="icon-2" target="_blank"></a>
                    <!--<a href="#" class="icon-1"></a>-->
                </div>
                <div class="clear"></div>
               </div>
         </nav>
      </div>
    

    </header>