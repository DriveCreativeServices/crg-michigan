<?php

require 'includes/mysql.php';
require'includes/google-analytics-tag.php';

require 'includes/login-logout.php';

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CRG Michigan - Connecting and Supporting Michigan Small Business</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/icon/favicon.png">
    
    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <main>
        <?php include 'includes/header.php'; ?>
        <!-- Hero Area Start-->
        <div class="slider-area hero-bg1">
            <div class="single-slider hero-overly  slider-height1 d-flex align-items-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-11">
                            <!-- Hero Caption -->
                            <p style="text-align: center;"><img src="assets/img/hero/CRG-Logo-3x-white.png" style="width: 80%;"></p>
                            <div class="hero-caption pt-10">
                                <h5 style="color: white; font-weight: 700;"><i>Connecting Michigan One Community at a Time</i></h5>
                            </div>
                            <div class="hero-search" style="display: flex; align-items: center; justify-content: center;">
                                <form style="width: 100%; padding: 25px;">
                                    <div class="form-group" style="display: flex;">
                                        <input type="text" class="form-control" name="search" placeholder="Find your community..." style="height: 45px; margin-top: 12px; border-radius: 10px;">
                                        <a href="community.php"><img src="assets/img/icon/search.png" style="width: 70px; margin-left: -40px;"></a>
                                     </div>
                                     
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Hero Area End-->
        
        <section class="business-promo-section" style="background-color: #223270;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8" style="background-color: #223270; padding: 50px;">
                        <h1 style="font-size: 40pt; font-weight: 800; padding-bottom: 15px;">Business Listings</h1>
                        <h1 style="margin: 0px; font-size: 20pt; padding: 10px 0px;">Get Residents Involved</h1>
                        <hr style="margin: 0px;">
                        <p style="margin: 0px; font-size: 20pt; padding: 10px 0px;">
                            Through your own business profile we connect you directly to the residents of your city.
                        </p>
                    </div>
                    <div class="col-sm-4" style="text-align: center;">
                        <div style="display: flex; align-items: center; justify-content: center;">
                            <a href="business-registration.php" style="position: absolute; background-color: #99AAE8; width: 15rem; height: 50px; color: white; font-weight: 600; text-align: center; display: flex; align-items: center; justify-content: center; border-radius: 10px;">
                            <i  style="font-size: 20pt;">Sign up</i>
                            </a>
                            <img src="assets/img/CRG_DesktopBusiness.png" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Business Promo Start -->
        <!--<section class="business-promo-section">-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-sm">-->
        <!--                <h1>Promote your small business</h1>-->
        <!--                <p>Create a business profile, feature your business, and appear in search results.</p>-->
        <!--            </div>-->
        <!--            <div class="col-sm" style="text-align: center;">-->
        <!--                <a href="business-registration.php" class="business-promo-section-btn">Sign up</a>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->

        <!-- Business Promo END -->

        <?php // include 'includes/how-it-works.php'; ?>
        
        <?php // include 'includes/interests.php'; ?>
        
        <section>
            <div class="row" style="width: 100%;">
                <div class="col-sm" style="padding: 25px;">
                    <img src="assets/img/innovator.png" style="width: 100%;">
                </div>
                <div class="col-sm" style="padding: 25px;">
                    <img src="assets/img/insider.png" style="width: 100%;">
                </div>
                <div class="col-sm" style="padding: 25px;">
                    <img src="assets/img/rare.png" style="width: 100%;">
                </div>
                <div class="col-sm" style="padding: 25px;">
                    <img src="assets/img/chesterfield.jpg" style="width: 100%;">
                </div>
                <div class="col-sm" style="padding: 25px;">
                    <img src="assets/img/mtclemens.jpg" style="width: 100%;">
                </div>
            </div>
            <p style="text-align: center; font-size: 50pt; font-weight: 100; color: #1a213d;"><i>Closer Than You Think.</i></p>
        </section>

        
        
        <?php // include 'includes/testimonials.php'; ?>
    </main>
    
    <?php include 'includes/footer.php'; ?>

<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>

<!-- Slick-slider , Owl-Carousel ,slick-nav -->
<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>
<script src="./assets/js/jquery.slicknav.min.js"></script>

<!--wow , counter , waypoint, Nice-select -->
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.counterup.min.js"></script>
<script src="./assets/js/waypoints.min.js"></script>

<!-- contact js -->
<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

<!--  Plugins, main-Jquery -->	
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>
</body>
</html>