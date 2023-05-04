<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

$cityId = $_GET['id'];

$cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$cityId'");
$cityidf = mysqli_fetch_array($cityidq);

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $cityidf['city_name']; ?> | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/icon/favicon.png">
    
        <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    
    <!-- CSS here -->
    <!--<link rel="stylesheet" href="assets/css/bootstrap.min.css">-->
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
                                <h1><?php echo $cityidf['city_name']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Hero Area End-->
        
        <div class="row flex-sm-row-reverse">
            <div class="col-sm-2 text-center" style="padding: 20px 0px; background-color: #d0ddff; margin-left: auto; margin-right: auto;">
                <div class="sticky-sidebar-content">
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 30px; background-color: #1a213d; border: 0px; width: 200px; height: 50px; display: initial!important;">
                    + Create Post
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="add-event.php">Event</a></li>
                    <li><a class="dropdown-item" href="add-listing.php">Listing</a></li>
                    <li><a class="dropdown-item" href="add-obituary.php">Obituary</a></li>
                  </ul>
                </div>
                <div style="padding-top: 20px;">
                    <a href="#calendar" class="post-type-btn">Calendar</a>
                    <a href="#upcoming-events" class="post-type-btn">Events</a>
                    <a href="#latest-news" class="post-type-btn">Articles</a>
                    <a href="#listings" class="post-type-btn">Listings</a>
                    <a href="#obituaries" class="post-type-btn">Obituaries</a>
                    <a href="#businesses" class="post-type-btn">Businesses</a>
                </div>
                <div style="padding-top: 20px;">
                    <h4>Helpful links:</h4>
                    <ul>
                        <?php
                        $cityLinksq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$cityId'");
                        while($cityLinks = mysqli_fetch_array($cityLinksq)) {
                            $cityLinksArray = preg_split ("/\,/", $cityLinks['city_links']);
                            $numCityLinks = count($cityLinksArray);
                            for($i = 0; $i < $numCityLinks; $i++){
                                echo '
                                    <li><a href="'.$cityLinksArray[$i].'" target="_blank">'.$cityLinksArray[$i].'</a></li>
                                ';
                            }                             
                            
                        }
                        
                        ?>
                        <!--<li><a href="#">Link 1</a></li>-->
                        <!--<li><a href="#">Link 2</a></li>-->
                        <!--<li><a href="#">Link 3</a></li>-->
                    </ul>
                </div>
                </div>
            </div>
                        <div class="col-sm-10" style="padding: 0px;">
                <?php include 'includes/download-newsletter.php'; ?>
    
                <?php include 'includes/calendar.php'; ?>
                
                <?php include 'includes/upcoming-events.php'; ?>
        
                <?php include 'includes/latest-news.php'; ?>
        
                <?php //include 'includes/top-industries.php'; ?>
                
                <?php include 'includes/city-listings.php'; ?>
                
                <?php include 'includes/city-obituaries.php'; ?>
        
                <?php include 'includes/featured-businesses.php'; ?>
                
                 <?php include 'includes/want-see-more.php'; ?>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>

<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
  crossorigin="anonymous"
></script>
    
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"
></script>

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