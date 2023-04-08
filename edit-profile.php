<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if(isset($_COOKIE['login'])){
    $username = $_COOKIE['login'];
} else {
    $username = '';
    header('Location: login.php');
}

$bizId = $_GET['id'];

$bizDetailsq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '$bizId'");
$bizDetails = mysqli_fetch_array($bizDetailsq);

// GET BIZ INDUSTRY
$bizIndustryq = mysqli_query($con, "SELECT * FROM `industry` WHERE `id` = '".$bizDetails['business_industry_id']."'");
$bizIndustry = mysqli_fetch_array($bizIndustryq);

// GET BIZ CTIY
$bizCityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$bizDetails['business_city_id']."'");
$bizCity = mysqli_fetch_array($bizCityq);

// DO SOMETHING ON SUBMIT OF EDIT PROFILE
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    $website = $_POST['website'];
    $about = $_POST['about'];

    $img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);


    $allowed_exs = array("jpg", "jpeg", "png"); 

    if (in_array($img_ex_lc, $allowed_exs)) {
        // Image 1
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = 'assets/img/business-logos/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    } else {
        $new_img_name = '';
    }

    if($about != ''){
        $insertAbout = $about;
    } else {
        $insertAbout = $bizDetails['business_about'];
    }

    if($new_img_name != ''){
        $insertLogo = $new_img_name;
    } else {
        $insertLogo = $bizDetails['business_logo'];
    }

    mysqli_query($con, "UPDATE `business` SET 
        `business_phone` = '$phone',
        `business_email` = '$email',
        `business_website` = '$website',
        `business_about` = '$insertAbout',
        `business_logo` = '$insertLogo',
        `business_approved` = 1
        WHERE 
        `id` = $bizId") or die(mysqli_error($con));

    header("Location: company.php?id=".$bizId);
    
}

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Profile | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
                                <h2>Edit Profile</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--  Hero area End -->

        <div class="container">

        <!-- Edit company START-->
        <section>
            <div class="container" style="padding: 50px 50px;">
            <h2 style="padding-bottom: 25px;">Edit Profile</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $bizDetails['business_name']?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="industry">Industry</label>
                            <input type="text" list="industry" class="form-control" name="industry" value="<?php echo $bizIndustry['industry_name'] ?>" disabled>
                            <datalist id="industry">
                                <?php


                                    $industriesq = mysqli_query($con, "SELECT * FROM `industry`");
                                    while($industries = mysqli_fetch_array($industriesq)) {

                                        echo 
                                            '
                                            <option value="'.$industries['industry_name'].'">'.$industries['industry_name'].'</option>
                                            ';
                                    }
                                ?>
                            </datalist>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="street">Street Address</label>
                            <input type="text" class="form-control" id="street" name="street" value="<?php echo $bizDetails['business_street']?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" list="city" class="form-control" name="city" value="<?php echo $bizCity['city_name'] ?>" disabled>
                            <datalist id="city">
                                <?php

                                    $citiesq = mysqli_query($con, "SELECT * FROM `city`");
                                    while($cities = mysqli_fetch_array($citiesq)) {

                                        echo 
                                            '
                                            <option value="'.$cities['city_name'].'">'.$cities['city_name'].'</option>
                                            ';
                                    }
                                ?>
                            </datalist>
                        </div>
                    </div>
                </div>
                <p style="color: black;">Want to change your business's name, industry, address, or city? Please <a href="business-change-request.php?id=<?php echo $bizId ?>" style="color: #0d6efd; text-decoration: underline;">submit a request</a>.</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $bizDetails['business_email']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $bizDetails['business_phone']?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        Upload a new logo:
                        <input type="file" name="my_image" class="form-control" id="my_image" value="<?php echo $bizDetails['business_logo']?>">
                        <small><b>(THIS WILL REPLACE YOUR CURRENT LOGO)</b>. Image should be 400 x 400px and of the type .jpg, .jpeg, or .png</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $bizDetails['business_facebook']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo $bizDetails['business_instagram']?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="linkedin">LinkedIn</label>
                            <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo $bizDetails['business_linkedin']?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" value="<?php echo $bizDetails['business_website']?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea class="form-control" id="about" rows="5" name="about" placeholder="<?php echo $bizDetails['business_about']?>"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </form>
            </div>
        </section>
        <!-- Edit company END-->

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