<?php
require 'php/template.php';

$title = 'Longo Corporation - Home Page';
$description = 'This is the description';
$keywords = 'These are the keywords';

printHead($title, $description, $keywords);
printHeader();
?>

<!--==============================content================================-->


<section id="content">

    <div class="slider-main">
        <div id="demo" class="carousel carousel-fade" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/slider-1.jpg" alt="" />
                    <div class="carousel-caption">
                        <p data-animation="animated bounceInRight">No Hassle Facility Management &nbsp;</p>
                    </div>   
                </div>
                <div class="carousel-item">
                    <img src="images/slider-2.jpg" alt="" />
                    <div class="carousel-caption">
                        <p data-animation="animated bounceInRight">Call Today To Request a Quote</p>
                    </div>   
                </div>
                <div class="carousel-item">
                    <img src="images/slider-3.jpg" alt="" />
                    <div class="carousel-caption">

                        <p data-animation="animated bounceInRight">We Craft Practical Facility Management Solutions&nbsp;</p>
                    </div>   
                </div>
            </div>

        </div>

    </div>

    <div class="container_12">
        <div class="grid_12">
            <div class="container">
                <div class="border-1 top-box">
                    <h2 class="top-1">What is Facility Management?</h2>
                    <p class="p2">Facility (or Facilities) management (FM) is an interdisciplinary field devoted to the co-ordination of business support services, often associated with maintenance functions in buildings such as offices, arenas, schools, convention centers, shopping complexes, hospitals, hotels, etc. However, FM supports the business on a much wider range of activities than just maintenance and these are referred to as non core functions. </p>
                </div>
            </div>
            <div class="wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="tb">
                                <h3>We Work For You</h3>
                                <img src="images/page1-img1.jpg" alt="" class="img-border">
                                <p>Our aim is simply to take the strain out of running your support services, freeing you to concentrate on the performance and profitability of your core business.<br /><br />
                                    And because providing support services is our core business, we will use our expertise and market knowledge to save you money, without compromising the professionalism and efficiency of your organization.</p>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="tb">
                                <h3>Our Strategy</h3>
                                <img src="images/page1-img2.jpg" alt="" class="img-border">
                                <p>It's not only our promise, it's the way business gets done. Every Member of our team from the President on down is cross trained in many of our core functions, and every employee is empowered to innovate and constantly improve our current and future processes. This ideology allows us to not only provide better services, but to provide greater value to our clients.</p>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="last tb">
                                <h3>Clients Choose Us</h3>
                                <img src="images/page1-img3.jpg" alt="" class="img-border">
                                <p>The decision to outsource a function is an important one. No matter what services you outsource, the competency of the provider you choose will affect the outcome – and your level of satisfaction. With more than 20 years of experience serving diverse client industries and multiple facility types, Longo Corporation stands ready to deliver facility solutions to meet your requirements – whatever those needs may be and wherever your properties are located. </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="aside">
            <div class="container_12">	
                <div class="grid_12">





                    <div>
                        <div class="container">
                            <h2 class="top-1">Our Mission</h2>
                            <p >“We shall strive to provide quality goods and services which satisfy the needs of building occupants while meeting the quality, safety and financial objectives of our customers.”
                                <br /><br />
                                To accomplish this mission, Longo Corporation FMS will continuously improve its services and knowledge through education, technology upgrades and additional business partnerships and alliances.</p>
                        </div>
                    </div>


















                    <div class="pad-2 block-2 wrap">
                        <div>
                            <h3 class="p3"></h3>
                            <p class="p4">

                            </p>

                        </div>

                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>  
</section> 


<script >
    (function ($) {
        //Function to animate slider captions
        function doAnimations(elems) {
            //Cache the animationend event in a variable
            var animEndEv = "webkitAnimationEnd animationend";

            elems.each(function () {
                var $this = $(this),
                        $animationType = $this.data("animation");
                $this.addClass($animationType).one(animEndEv, function () {
                    $this.removeClass($animationType);
                });
            });
        }

        //Variables on page load
        var $myCarousel = $("#demo"),
                $firstAnimatingElems = $myCarousel.
                find(".carousel-item:first").
                find("[data-animation ^= 'animated']");

        //Initialize carousel
        $myCarousel.carousel();

        //Animate captions in first slide on page load
        doAnimations($firstAnimatingElems);

        //Other slides to be animated on carousel slide event
        $myCarousel.on("slide.bs.carousel", function (e) {
            var $animatingElems = $(e.relatedTarget).find(
                    "[data-animation ^= 'animated']");

            doAnimations($animatingElems);
        });
    })(jQuery);
//# sourceURL=pen.js
</script>


<?php printFooter(); ?>