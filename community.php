<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if(isset($_POST['submit'])){
    $city = $_POST['city'];
    header('Location: city.php?city='.$city);
}

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Community | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
        <!-- Hero area Start-->
        <div class="slider-area">
            <div class="slider-height2 hero-bg1 hero-overly d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-caption hero-caption2">
                                <h2>COMMUNITY</h2>
                                <h2 style="font-weight: 500;">Where You Call Home</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--  Hero area End -->

        <!-- List of Cities Start -->
        <section id="cities">
            <div class="container">
                <?php
                $numCols = 4;
                $rowCount = 0;
                $colWidth = 12 / $numCols;
                ?>
    
                <div class="row" style="padding: 50px 0px 0px 0px;">
    
                <?php
    
                $citiesq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_approved` = 1 ORDER BY `city_name` ASC");
                while($cities = mysqli_fetch_array($citiesq)) {
                    $rowCount++;
                    echo 
                        '
                        <div class="col-md-'.$colWidth.'" style="text-align: center; display: flex; justify-content: center;">
                            <a href="city.php?id='.$cities['id'].'">
                                <div class="city-thumbnail" style="background-image: url(assets/img/city-images/'.$cities['city_image'].'); background-size: cover; box-shadow: inset 0 0 0 1000px rgba(34,50,112,.4);">
                                    <!--<img src="" alt="" width="300" height="300">-->
                                    <div style="  position: absolute; bottom: 0; left: 0; padding-left: 25px; padding-bottom: 55px;"></div>
                                    <div class="city-text-centered" style="font-weight: 800; font-size: 18pt;">'.$cities['city_name'].'</div>
                                </div>
                            </a>
                            
                        </div>
                        ';
                    
                    if($rowCount % $numCols == 0) echo '</div><div class="row" style="padding: 0px 0px 50px 0px;">';
                }
    
                ?>
                
            </div>
        </section>
        <!-- List of Cities END -->
        


        <?php include 'includes/dont-see-community.php'; ?>

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