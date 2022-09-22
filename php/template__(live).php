<?php function printHead($title,$description,$keywords) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print $title;?></title>
    <meta charset="utf-8">
    <meta name= "description" content="<?php print $description;?>" />
    <meta name="keywords" content="<?php print $keywords;?>" /> 
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/grid_12.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/slider.css">
    <link href='http://fonts.googleapis.com/css?family=Condiment' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <script src="js/jquery-1.7.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/tms-0.4.x.js"></script>
    <script>
		$(document).ready(function(){				   	
			$('.slider')._TMS({
				show:0,
				pauseOnHover:true,
				prevBu:false,
				nextBu:false,
				playBu:false,
				duration:1000,
				preset:'fade',
				pagination:true,
				pagNums:false,
				slideshow:7000,
				numStatus:true,
				banners:'fromRight',
				waitBannerAnimation:false,
				progressBar:false
			})		
		});
	</script>
	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
    	<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
	<![endif]-->
</head>    
<?php
}

function printHeader() {?>
<body>
  <div class="main">
  <!--==============================header=================================-->
    <header>
        <div id="logoName">
        <a href="index.html"><img src="images/longoLogo.png" class="longoLogo" alt="Longo Corporation Logo"></a>        
        <h2 class="longoH1">
            Longo Corporation
            <br />
            <span class="subHeading">
                Facilities Management Services
            </span>
        </h2>    
        </div>
        
        <div id="slogan">
            <span class="sloganItem" style="margin-left:550px">
                Innovation
            </span>
            <span class="sloganItem" style="margin-left:650px">
                Direction
            </span>
            <span class="sloganItem" style="margin-left:750px">
                Solutions
            </span>
        </div>
  
        <div class="clear"></div>    
        <nav class="box-shadow">
            <div>
                <ul class="menu">
                    <li class="home-page"><a href="index.php"><span></span></a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="vendor.php">Become a Vendor</a></li>
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
    </header> 
  <?php

}

/** 
 * Print Footer HTML
 *
 * There are no parameters for this function

 */
function printFooter() {
?>
  </div>    
<!--==============================footer=================================-->
    <footer>
        <p>© 2013 Longo Corporation</p>
        <p><a rel="nofollow" href="http://seplak.com/" target="_blank" class="link">Website</a> by Seplak Web Design</p>
        <p><a style="text-decoration: underline;color:gold;" href="http://www.longocorporation.com/admin">Time Log Access</a></p>
    </footer>	    
</body>
</html>    
<?php
}

function printHeadAdmin($title,$description,$keywords) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print $title;?></title>
    <meta charset="utf-8">
    <meta name= "description" content="<?php print $description;?>" />
    <meta name="keywords" content="<?php print $keywords;?>" /> 
    <link rel="stylesheet" type="text/css" media="screen" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/grid_12.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/slider.css">
    <link href='http://fonts.googleapis.com/css?family=Condiment' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
    <script src="../js/jquery-1.7.min.js"></script>
    <script src="../js/jquery.easing.1.3.js"></script>
    <script src="../js/tms-0.4.x.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/jq_hover.js"></script>

	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="../js/html5.js"></script>
    	<link rel="stylesheet" type="text/css" media="screen" href="../css/ie.css">
	<![endif]-->
</head>    
<?php
}

function printHeaderAdmin() {?>
<body>
  <div class="main">
  <!--==============================header=================================-->
    <header>
        <div id="logoName">
        <a href="index.html"><img src="../images/longoLogo.png" class="longoLogo" alt="Longo Corporation Logo"></a>        
        <h2 class="longoH1">
            Longo Corporation
            <br />
            <span class="subHeading">
                Facilities Management Services
            </span>
        </h2>    
        </div>
        
        <div id="slogan">

            <span class="sloganItem" style="margin-left:650px;margin-top:30px;">
                Time Log Access
            </span>

        </div>
  <?php 
    if(isset($_SESSION['userName'])){
        $href = '../php/logout.php';
        $logInOut = 'Log Out';
    }

  ?>
        <div class="clear"></div>    
        <nav class="box-shadow">
            <div>
                <ul class="menu">
                    <?php 
                        if(isset($_SESSION['userName'])){
                        	print '<li><a href="manageJobs.php">';
                        	if($_SESSION['userRole']=='admin'){
                        		print 'Manage Jobs';
								}
else{
	print 'View Jobs';
	}
                        	print '</a></li>';
                            if($_SESSION['userRole']== 'admin' || $_SESSION['userRole']=='developer'){?>

                        
                        <li><a href="manageUsers.php">Manage Users</a></li>
                        <li><a href="manageLocations.php">Manage Locations</a></li>

                    <?php }} 
                        if(isset($_SESSION['userName'])){?>
                         <li>
                            <a href="<?php print $href?>">
                                <?php print $logInOut;?>
                            </a>
                        </li>                           
                        
                        <?php }
                    ?>
                        
                        
                </ul>
                <div class="social-icons">
                    <span>
                    <?php
                        if(isset($_SESSION['userName'])){
                            print 'Logged in as ' . $_SESSION['userName'];
                        }
                    ?>
                    </span>

                </div>
                <div class="clear"></div>
            </div>
        </nav>
    </header> 
  <?php

}
function printHeadLog($title,$description,$keywords) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php print $title;?></title>
    <meta charset="utf-8">
    <meta name= "description" content="<?php print $description;?>" />
    <meta name="keywords" content="<?php print $keywords;?>" /> 
    <link rel="stylesheet" type="text/css" media="screen" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/grid_12.css">
    <!--<link rel="stylesheet" type="text/css" media="screen" href="css/slider.css">-->
    <link href='http://fonts.googleapis.com/css?family=Condiment' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <!--<script src="js/jquery-1.7.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/tms-0.4.x.js"></script>-->

	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
    	<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
	<![endif]-->
</head>    
<?php
}

function printHeaderLog() {?>
<body>
  <div class="main">
  <!--==============================header=================================-->
    <header>
        <div id="logoName">
        <a href="index.html"><img src="../images/longoLogo.png" class="longoLogo" alt="Longo Corporation Logo"></a>        
        <h2 class="longoH1">
            Longo Corporation
            <br />
            <span class="subHeading">
                Facilities Management Services
            </span>
        </h2>    
        </div>
        
        <div id="slogan">

            <span class="sloganItem" style="margin-left:650px;margin-top:30px;">
                Time Log Access
            </span>

        </div>
  <?php 
    if(isset($_SESSION['userName'])){
        $href = '../php/logout.php';
        $logInOut = 'Log Out';
    }

  ?>
        <div class="clear"></div>    

    </header> 
  <?php

}
?>
