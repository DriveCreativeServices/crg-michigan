<?php

require 'includes/login-logout.php';

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
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
<style>
body, html {
  height: 100%;
  margin: 0;
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}
</style>
<body>
    <header>
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper d-flex align-items-center justify-content-between">
                        <div class="left-content d-flex align-items-center">
                            <!--<div class="logo">-->
                            <!--    <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>-->
                            <!--</div>-->
                            
                            <!-- Main-menu -->
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">              
                                        <li><a href="company-demo.php">Demo Company</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="main-menu d-none d-lg-block">
                            </div>
                        </div> 
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none">
                            <div class="slicknav_menu">
                                <a href="#" aria-haspopup="true" role="button" tabindex="0" class="slicknav_btn slicknav_open" style="outline: none;"><span class="slicknav_menutxt">MENU</span><span class="slicknav_icon"><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span><span class="slicknav_icon-bar"></span></span></a><ul class="slicknav_nav" style="display: block;" aria-hidden="false" role="menu">              
                                        <li><a href="company.php" role="menuitem" tabindex="0">Demo Company</a></li>

                            </ul>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

<!-- Hero Area Start-->
<div class="slider-area hero-bg1" style="height: 100%;">
            <div class="single-slider hero-overly  slider-height1 d-flex align-items-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-11">
                            <!-- Hero Caption -->
                            <div class="hero-caption pt-10">
                                <img src="assets/img/logo/logo.png" style="padding-bottom: 25px;">
                                <h1>Under Maintenance</h1>
                                <p>CRG Digital is currently undergoing maintenance. Please contact <a href="mailto:info@drivecreativeservices.com">info@drivecreativeservices.com</a> for any questions or feel free to register your business.</p>
                            </div>
                            <!--Hero form -->
                            <!-- <form action="#" class="search-box mb-45">
                                <div class="input-form">
                                    <input type="text" placeholder="Ex: Food, Service, Hotel, Shopping">
                                    <span>What?</span>
                                </div>
                                <div class="input-form">
                                    <input type="text" placeholder="Your City....">
                                    <span>Where?</span>
                                </div>
                                <div class="search-form">
                                    <a href="#"><i class="fas fa-search"></i>Search</a>
                                </div>	
                            </form>	 -->
                            <!-- hero category1 img -->
                            <div class="category-items text-center">
                                <ul>
                                    <li><a href="business-registration.php" style="width: 300px;">Register your business</a></li>
                                    <!-- <li><a href="industries.php">Products & Services</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Hero Area End-->

<script>
// Set the date we're counting down to
var countDownDate = new Date("Aug 1, 2022 15:37:25").getTime();

// Update the count down every 1 second
var countdownfunction = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
  
  // Find the distance between now an the count down date
  var distance = countDownDate - now;
  
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
  
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(countdownfunction);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

</body>
</html>
