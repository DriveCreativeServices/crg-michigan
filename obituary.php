<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

$listingId = $_GET['id'];

$listingDetailsq = mysqli_query($con, "SELECT * FROM `obituary` WHERE `id` = '$listingId'");
$listingDetails = mysqli_fetch_array($listingDetailsq);

$deceasedName = $listingDetails['deceased_name'];
$name = $listingDetails['name'];
$cityId = $listingDetails['city_id'];
$description = $listingDetails['description'];
$listingDate = date('F j, Y', strtotime($listingDetails['timestamp']));

if($listingDetails['image'] == ''){
  $displayListingImage = "<img src='assets/img/gallery/directory1.jpg' alt='' style='width: 100%; height: 100%; object-fit: cover;'>";
} else {
  $displayListingImage = "<img src='assets/img/obituary-images/".$listingDetails['image']."' alt='' style='width: 100%; height: 100%; object-fit: cover;'>";
}

$cityDetailsq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$cityId'");
$cityDetails = mysqli_fetch_array($cityDetailsq);
$city = $cityDetails['city_name'];

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
  <?php include 'includes/google-analytics-tag.php'; ?>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $deceasedName ?> | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/icon/favicon.png">

  <!-- ARTICLE METADATE FOR SOCIAL SHARING -->
  <meta property="og:title" content="<?php echo $title?>" />
  <meta property="og:image" content="assets/img/article-images/<?php echo $listingDetails['image']?>"/>
  <meta property="og:url" content="http://www.crgmichigan.com/listing.php?id=<?php echo $listingId?>"/>
  <meta property="og:description" content="<?php echo $description?>"/>

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
 <?php include 'includes/header.php'; ?>
<main>
 <!-- Hero area Start-->
 <div class="slider-area">
  <div class="slider-height2 hero-bg2 hero-overly d-flex align-items-center">
   <div class="container">
    <div class="row">
      <div class="col-xl-12">
       <div class="hero-caption hero-caption2">
        <h2><?php echo $deceasedName?></h2>
      </div>
    </div>
  </div>
</div>
</div> 
</div>
<!--  Hero area End -->
<!-- Blog Area Start -->
<section class="blog_area single-post-area section-padding">
  <div class="container">
   <div class="row">
    <div class="col-lg-8 posts-list">
     <div class="single-post">
      <div class="feature-img">
       <?php echo $displayListingImage?>
     </div>
     <div class="blog_details">
       <h2 style="color: #2d2d2d;"><?php echo $deceasedName ?></h2>
      <ul class="blog-info-link mt-3 mb-4">
        <li><a href="#"><i class="fa fa-city"></i>
          <?php 
              echo "".$cityDetails['city_name']." |  <i class='fa fa-clock'></i> ".$listingDate."</a>";
              ?>
        </li>
      </ul>
      <div class="excert">
        <?php echo $description?>
      </div>
  </div>
</div>
<div class="navigation-top">
  <div class="d-sm-flex justify-content-between text-center">
   <div class="col-sm-4 text-center my-2 my-sm-0">
   </div>
    <ul class="social-icons">
      <li>Share Obituary: </li>
    <li><a href="http://www.facebook.com/sharer.php?u=http://crgmichigan.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="http://twitter.com/share?url=http://www.crgmichigan.com/listing.php?id=<?php echo $listingId?>&text=Check out this local listing from CRG Michigan: <?php echo $title?>&hashtags=CRGMichigan,ConnectingMichigan,SmallBusiness" target="_blank"><i class="fab fa-twitter"></i></a></li>
  </ul>
</div>
</div>
</div>


<div class="col-lg-4">
 <div class="blog_right_sidebar">
    <?php 
        if($listingDetails['obituary_approved'] == 0){
            echo '<h4 style="color: red;">Waiting for Approval</h4>';
        }
    ?>
    <aside class="single_sidebar_widget popular_post_widget">
      <h3 class="widget_title" style="color: #2d2d2d;">Funeral Home</h3>
      
    </aside>
  </div>
</div>
</div>
</div>
</section>
<!-- Blog Area End -->
</main>

<?php include 'includes/footer.php';?>
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