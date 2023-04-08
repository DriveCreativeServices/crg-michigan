<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

$bizId = $_GET['id'];

$bizDetailsq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '$bizId'");
$bizDetails = mysqli_fetch_array($bizDetailsq);

// GET BIZ INDUSTRY
$bizIndustryq = mysqli_query($con, "SELECT * FROM `industry` WHERE `id` = '".$bizDetails['business_industry_id']."'");
$bizIndustry = mysqli_fetch_array($bizIndustryq);

// GET BIZ CTIY
$bizCityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$bizDetails['business_city_id']."'");
$bizCity = mysqli_fetch_array($bizCityq);

if(isset($_POST['submit'])){
    $newName = $_POST['name'];
    $newIndustry = $_POST['industry'];
    $newAddress = $_POST['address'];
    $newCity = $_POST['city'];
    
    mysqli_query($con, "INSERT INTO `business_change_request` (`biz_id`, `new_name`, `new_industry`, `new_address`, `new_city`) VALUES ('$bizId', '$newName', '$newIndustry', '$newAddress', '$newCity')") or die(mysqli_error($con));
    echo "<script>alert('Change request submitted!')</script>";
}

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Change Request | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
    <?php include 'includes/header.php'; ?>
    <main>
        <!-- Hero area Start-->
        <div class="slider-area">
            <div class="slider-height2 hero-bg2 hero-overly d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-caption hero-caption2">
                                <h2>Business Change Request</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--  Hero area End -->

        <div class="container">

        <!-- Add a article START-->
        <section>
            <div class="container" style="padding: 50px 50px;">
                <h2 style="padding-bottom: 25px;">Business Change Request</h2>
                <form method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $bizDetails['business_name']?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="industry">Industry</label>
                            <input type="text" class="form-control" name="industry" value="<?php echo $bizIndustry['industry_name']?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                      <label for="address">Street Address</label>
                      <input type="text" class="form-control" name="address" value="<?php echo $bizDetails['business_street']?>" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="city">City</label>
                      <input type="text" class="form-control" name="city" value="<?php echo $bizCity['city_name']?>" required>
                    </div>
                  </div>
                  
                <button type="submit" class="btn btn-primary" name="submit">Send Request</button>
                </form>
            </div>
        </section>
        <!-- Add a article END-->

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

    <!-- Text area library -->
    <script src='tinymce/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: '#article-body'
        });
    </script>
    </body>
</html>