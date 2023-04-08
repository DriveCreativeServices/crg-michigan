<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

$searchTerm = $_GET['search'];

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Search Results | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
            <div class="single-slider hero-overly  slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-11">
                            <!-- Hero Caption -->
                            <div class="hero-caption pt-10">
                                <h1>Search Results</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Hero Area End-->

        <div class="container">
            <div class="search-results">
                <div class="are-results">
                    <?php
                        // Business search results
                        $bizDetailsq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_name` LIKE '%{$searchTerm}%'");
                        $bizResults = mysqli_num_rows($bizDetailsq);
                        while($bizDetails = mysqli_fetch_array($bizDetailsq)){
                            echo 
                            '
                            <a href="company.php?id='.$bizDetails['id'].'">
                                <div class="search-row">
                                    <p class="search-tag">Business</p>
                                    <p>'.$bizDetails['business_name'].'</p>
                                </div>
                            </a>
                            ';
                            }

                        // City search results
                        $cityDetailsq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_name` LIKE '%{$searchTerm}%'");
                        $cityResults = mysqli_num_rows($cityDetailsq);
                        while($cityDetails = mysqli_fetch_array($cityDetailsq)){
                            echo 
                            '
                            <a href="city.php?id='.$cityDetails['id'].'">
                                <div class="search-row">
                                    <p class="search-tag">City</p>
                                    <p>'.$cityDetails['city_name'].'</p>
                                </div>
                            </a>
                            ';
                            }

                        // Article search results
                        $articleDetailsq = mysqli_query($con, "SELECT * FROM `article` WHERE `article_title` LIKE '%{$searchTerm}%'");
                        $articleResults = mysqli_num_rows($articleDetailsq);
                        while($articleDetails = mysqli_fetch_array($articleDetailsq)){
                            echo 
                            '
                            <a href="article.php?id='.$articleDetails['id'].'">
                                <div class="search-row">
                                    <p class="search-tag">Article</p>
                                    <p>'.$articleDetails['article_title'].'</p>
                                </div>
                            </a>
                            ';
                            }
                        
                        // No Results
                        if($bizResults + $cityResults + $articleResults == 0){
                            echo 
                            '
                            <p>There are no search results for "'.$searchTerm.'".</p>
                            ';
                        }
                    ?>
                </div>
            </div>
        </div>

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