<?php

function printHead($title,$keywords,$description){?>
    <!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php print $title; ?></title>
        
        <meta charset="utf-8">
        <meta name="description" content="<?php print $description; ?>" />
        <meta name="keywords" content="<?php print $keywords; ?>" />
        <LINK REL="SHORTCUT ICON" HREF="favicon.ico" />
        <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
        <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
        <script type="text/javascript" src="js/jquery-1.6.js" ></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/cufon-replace.js"></script>
        <script type="text/javascript" src="js/Didact_Gothic_400.font.js"></script>
        <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
        <script type="text/javascript" src="js/atooltip.jquery.js"></script>
        <script type="text/javascript" src="js/jquery.jqtransform.js" ></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <!--[if lt IE 9]>
                <script type="text/javascript" src="js/html5.js"></script>
                <style type="text/css">
                        .bg{ behavior: url(js/PIE.htc); }
                </style>
        <![endif]-->
        <!--[if lt IE 7]>
                <div style=' clear: both; text-align:center; position: relative;'>
                        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/images/upgrade.jpg" border="0"  alt="" /></a>
                </div>
        <![endif]-->
    </head>
    
       <body id="page1">
        <div class="body1">
            <div class="main">
                <!-- header -->
                <header>
                    <h1><a href="index.html" id="logo"></a></h1>
                    <div class="wrapper">
                        <h2 class="headerRight">
                            708-214-9975

                            <br>
                            <a href="mailto:Longocorporation@gmail.com">Longocorporation@gmail.com</a>
                        </h2>
                    </div>

                    <div class="ic">More Website Templates @ TemplateMonster.com - October 10, 2011!</div>
                </header>


                <!-- / header -->
            </div>
        </div>
        <!-- content -->
        <div class="body2">

            <div class="main">
                <section id="">
                    <div class="wrapper topWrapper">
                        <nav>
                            <ul id="menu">
                                <li id=""><a href="index.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                <li><a href="info.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;What we can do for you&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                <li><a href="mls.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MLS Info&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>							<li class="end"><a href="contact.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contact Us</a></li>
                            </ul>
                        </nav>
<?php

}

function printFooter(){?>
       <!-- / content -->
        <div class="body4">
            <div class="main">
                <!-- footer -->
                <footer>
                    <img src="images/4castLogo.png" />

                    <span class="call">Call 4Cast Realty Group Today: <span>708-214-9975</span></span>
                    <br />

                    <span style="text-align: center;display: block;">Website by <a href="http://www.seplak.com/" target="_blank" rel="nofollow">Seplak Web Design</a><br></span>

                    <!-- {%FOOTER_LINK} -->
                </footer>

                <!-- / footer -->
            </div>
        </div>
        <script type="text/javascript"> Cufon.now();</script>
        <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider({
                    effect: 'sliceUpDown', //Specify sets like: 'fold,fade,sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft'
                    slices: 17,
                    animSpeed: 500,
                    pauseTime: 6000,
                    startSlide: 0, //Set starting Slide (0 index)
                    directionNav: false, //Next & Prev
                    directionNavHide: false, //Only show on hover
                    controlNav: true, //1,2,3...
                    controlNavThumbs: false, //Use thumbnails for Control Nav
                    controlNavThumbsFromRel: false, //Use image rel for thumbs
                    controlNavThumbsSearch: '.jpg', //Replace this with...
                    controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
                    keyboardNav: true, //Use left & right arrows
                    pauseOnHover: true, //Stop animation while hovering
                    manualAdvance: false, //Force manual transitions
                    captionOpacity: 1, //Universal caption opacity
                    beforeChange: function() {
                        $('.nivo-caption').animate({bottom: '-110'}, 400, 'easeInBack')
                    },
                    afterChange: function() {
                        Cufon.refresh();
                        $('.nivo-caption').animate({bottom: '-20'}, 400, 'easeOutBack')
                    },
                    slideshowEnd: function() {
                    } //Triggers after all slides have been shown
                });
                Cufon.refresh();
            });
        </script>
    </body>
</html> 
    
<?php

}

function printSideColumn(){?>
                        <article class="col2">
                            <form id="form_1" method="post">
                                <div class="pad1">
                                    <h3 sytle="font-size:12px;">
                                        How 4Cast Brings Home Buyers to Your Front Door!
                                    </h3>
                                    <ul style="list-style: disc;">
                                        <li>
                                            Access to the Largest Real Estate Database–The MLS.
                                        </li>
                                        <li>
                                            Internet links to real estate search engines
                                        </li>
                                        <li>
                                            Property Signage
                                        </li>
                                        <li>
                                            Analysis and Identification of “Feeder Towns”
                                        </li>
                                    </ul>

                                </div>
                            </form>
                        </article>

<?php
}
?>
