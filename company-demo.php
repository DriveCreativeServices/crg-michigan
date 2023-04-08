<?php

require 'includes/login-logout.php';

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $businessName ?> Demo Company | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
<header>
        <div class="header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper d-flex align-items-center justify-content-between">
                        <div class="left-content d-flex align-items-center">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                            
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-lg-block">
                            </div>
                        </div> 
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area hero-bg1">
            <div class="single-slider hero-overly slider-height3 d-flex align-items-end">
                <div class="container">
                    <div class="directory-details-head pb-40">
                        <div class="wants-wrapper w-padding3">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-xxl-8 col-xl-6 col-lg-6">
                                    <div class="details-cap d-flex">
                                        <!-- <div class="icon">
                                            <img src="assets/img/icon/restaurant-icon.svg" alt=""> 
                                        </div> -->
                                        <div class="properties__caption">
                                            <h2 style="color: white;">Demo Company</h2>
                                            <!-- <p>Let's uncover the best places to eat, drink</p>
                                            <div class="img-text">
                                                <span>$$$</span>
                                                <span class="open">Open Now</span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-6 col-lg-6">
                                    <div class="double-btn f-right  d-flex flex-wrap">
                                        <a href="#" target="_blank" class="border-btn w-btn wantToWork-btn"><i class="fas fa-globe"></i>Website</a>
                                        <a href="#" class="btn w-btn wantToWork-btn  ml-20"><i class="fas fa-phone-alt"></i>Call Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Hero Area End-->
        <!-- Directory Details start -->
        <div class="directory-details section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="small-tittle mb-20">
                            <h2>About</h2>
                        </div>
                        <div class="directory-cap mb-40">
                            <p style="color: black;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                        <div class="small-tittle mb-20">
                            <h2>Articles</h2>
                        </div>
                        <div class="gallery-img">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <img src="assets/img/gallery/directory1.jpg" class="mb-30" alt="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <img src="assets/img/gallery/directory2.jpg" class="mb-30" alt="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <img src="assets/img/gallery/directory3.jpg"  class="mb-30"alt="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <img src="assets/img/gallery/directory4.jpg"  class="mb-30"alt="">
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <div class="col-lg-4">
                        <div class="text-center" style="padding: 10px 0px;">
                                <button type="submit" name="submit" style="all: unset; cursor: pointer;">
                                <p class="btn">Add Article</p>
                                </button>

                                <button type="submit" name="submit" style="all: unset; cursor: pointer;">
                                <p class="btn">Edit Profile</p>
                                </button>
                        </div>
                        <div class="biz-social-area text-center">
                        
                            <a href="#" id="google"><i class="fab fa-google fa-4x" style="color: black;"></i></a>
                            <a href="#" id="facebook"><i class="fab fa-facebook fa-4x" style="color: black;"></i></a>
                            <a href="#" id="instagram"><i class="fab fa-instagram fa-4x" style="color: black;"></i></a>
                            <a href="#" id="twitter"><i class="fab fa-twitter fa-4x" style="color: black;"></i></a>
                            
                        </div>
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.1786539269224!2d55.27218771500953!3d25.197196983896188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43348a67e24b%3A0xff45e502e1ceb7e2!2sBurj%20Khalifa!5e0!3m2!1sen!2sbd!4v1588690958350!5m2!1sen!2sbd" width="100%" height="370" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                        <div class="form-wrapper2 pt-30">
                            <div class="row ">
                                <div class="col-xl-12">
                                    <div class="small-tittle mb-30">
                                        <h2>Contact</h2>
                                    </div>
                                </div>
                            </div>
                            <form id="contact-form2" action="#" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-box user-icon mb-15">
                                            <input type="text" name="name" placeholder="Your name">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-box email-icon mb-15">
                                            <input type="text" name="email" placeholder="Email address">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-box message-icon mb-15">
                                            <textarea name="message" id="message" placeholder="Comment"></textarea>
                                        </div>
                                        <button class="submit-btn2" type="submit">Send Message</button>
                                    </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Directory Details End -->
    </main>
    <footer>
        <div class="footer-wrapper gray-bg">
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row text-center">

                            <div class="single-footer-caption mb-25">
                                <div class="single-footer-caption mb-20">
                                    <!-- logo -->
                                    <div class="footer-logo mb-35">
                                        <a href="index.html"><img src="assets/img/logo/logo2_footer.png" alt="" height="100px;"></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>
                                                Explore your neighborhood's products & services, local happenings<br>
                                                dining & entertainment, places of interest and much more.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- social -->
                                    <!-- <div class="footer-social">
                                        <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                    </div> -->
                                </div>
                            </div>
         
                    </div>
                </div>
            </div>
    <!-- footer-bottom area -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="footer-border">
                <div class="row">
                    <div class="col-xl-12 ">
                        <div class="footer-copy-right text-center">
                            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Website by <a href="https://jacobjuszkowski.com" target="_blank">J2 Digital</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</footer>

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