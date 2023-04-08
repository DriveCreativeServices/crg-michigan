<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

// $businessName = $_GET['company'];
$businessID = $_GET['id'];

$bizDetailsq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '".$businessID."'");
$bizDetails = mysqli_fetch_array($bizDetailsq);
$businessName = $bizDetails['business_name'];
// $bizId = $bizDetails['id'];

$showFacebook = '';
$showInstagram = '';
$showLinkedin = '';
$showWebsite = '';

if($bizDetails['business_facebook'] != ""){
    $showFacebook = '
        <div class="col-sm">
            <a href="'.$bizDetails['business_facebook'].'" target="_blank"><img src="assets/img/icon/facebook.png" style="width: 50px;"/></a>
        </div>';
}

if($bizDetails['business_instagram'] != ""){
    $showInstagram = '
        <div class="col-sm">
            <a href="'.$bizDetails['business_instagram'].'" target="_blank"><img src="assets/img/icon/instagram.png" style="width: 50px;"/></a>
        </div>';
}

if($bizDetails['business_linkedin'] != ""){
    $showLinkedin = '
        <div class="col-sm">
            <a href="'.$bizDetails['business_linkedin'].'" target="_blank"><img src="assets/img/icon/linkedin.png" style="width: 50px;"/></a>
        </div>';
}

if($bizDetails['business_website'] != ""){
    $showWebsite = '
        <div class="col-sm">
            <a href="'.$bizDetails['business_website'].'" target="_blank"><img src="assets/img/icon/website.png" style="width: 50px;"/></a>
        </div>';
}

if($bizDetails['business_email'] != ''){
    $showEmail = '<a href="mailto:'.$bizDetails['business_email'].'" class="industry-contact-btn" style="width: 50%;"><i class="far fa-envelope" style="margin-right: 10px;"></i>Email</a>';
} else {
    $showEmail = '';
}

if($bizDetails['business_phone'] != ''){
    $showPhone = '<a href="tel:'.$bizDetails['business_phone'].'" class="industry-contact-btn" style="width: 50%;"><i class="fas fa-phone-alt" style="margin-right: 10px;"></i>Call</a>';
} else {
    $showPhone = '';
}

// Contact form
if(isset($_POST['contact'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    mail($bizDetails['business_email'], "Contact Request", "From: $name \n Email: $email \n Message: $message");
    echo '<script>alert("Your contact request has been sent!");</script>';
}


?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $businessName ?> | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
        <!-- Hero Area Start-->
        <div class="slider-area hero-bg1">
            <div class="single-slider hero-overly slider-height3 d-flex align-items-end" style="height: 300px;">
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
                                            <h2 style="color: white; font-size: 30pt; font-weight: 800;"><?php echo $businessName ?></h2>
                                            <!-- <p>Let's uncover the best places to eat, drink</p>
                                            <div class="img-text">
                                                <span>$$$</span>
                                                <span class="open">Open Now</span>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-xxl-4 col-xl-6 col-lg-6">-->
                                <!--    <div class="double-btn f-right  d-flex flex-wrap">-->
                                <!--        <a href="<?php echo $bizDetails['business_website']; ?>" target="_blank" class="border-btn w-btn wantToWork-btn"><i class="fas fa-globe"></i>Website</a>-->
                                <!--        <a href="tel:<?php echo $bizDetails['business_phone']; ?>" class="btn w-btn wantToWork-btn  ml-20"><i class="fas fa-phone-alt"></i>Call Now</a>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Hero Area End-->
        <!-- Directory Details start -->
        <div class="directory-details" style="padding: 50px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="small-tittle mb-20">
                            <h2 style="color: #000; font-size: 24pt; font-weight: 800;">About</h2>
                        </div>
                        <div class="directory-cap">
                            <p style="color: black; font-weight: 500;"><?php echo $bizDetails['business_about']; ?></p>
                            <?php echo $showPhone?>
                            <?php echo '<p class="business-contact-info">'.$bizDetails['business_phone'].'</p>'?>
                            <?php echo $showEmail?>
                            <?php echo '<p class="business-contact-info">'.$bizDetails['business_email'].'</p>'?>
                            <div class="biz-social-area">
                                <div class="row">
                                    <?php
                                    echo '
                                        '.$showFacebook.'
                                        '.$showInstagram.'
                                        '.$showLinkedin.'
                                        '.$showWebsite.'
                                    ';
                                    ?>
                                </div>
                            </div>
                                
                        </div>
                        <div class="small-tittle mb-20">
                            <h2 style="color: #000; font-size: 24pt; font-weight: 800;">Articles</h2>
                        </div>
                        <div class="gallery-img">
                            <div class="row">
                                <?php

                                $bizArticlesq = mysqli_query($con, "SELECT * FROM `article` WHERE `business_id` = $businessID AND `article_approved` = 1");
                                $articleCount = mysqli_num_rows($bizArticlesq);
                                $count = 0;
                                while($count < 4 && $bizArticles = mysqli_fetch_array($bizArticlesq)) {
                                    
                                    if($bizArticles['article_image'] == ''){
                                        $displayArticleImage = "<img src='assets/img/gallery/directory1.jpg' class='mb-30' alt='' style='height: 200px; object-fit: cover; border-radius: 10px;'>";
                                     } else {
                                         $displayArticleImage = "<img src='assets/img/article-images/".$bizArticles['article_image']."' class='mb-30' alt='' style='height: 200px; object-fit: cover; border-radius: 10px;'>";
                                     }

                                    echo 
                                    '
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <a href="article.php?id='.$bizArticles['id'].'">
                                        <div style="position: relative; box-shadow: 0px 6px 6px 0px rgb(2 25 65 / 15%); border-radius: 10px;">
                                            <p style="color: #000; background-color: #fff; position: absolute; bottom: 0; margin-bottom: 10px; width: 100%; padding-top: 10px; padding-left: 20px; ">'.$bizArticles['article_title'].'<p>
                                            '.$displayArticleImage.'
                                        </div>
                                        </a>
                                    </div>
                                    ';

                                    $count++;
                                }

                                if($articleCount > 4){
                                    echo '<a href="more-articles.php?article='.$bizArticles['id'].'" style="color: blue; text-decoration: underline;">Show More</a>';
                                }
                                ?>
                                
                                <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                                    <img src="assets/img/gallery/directory2.jpg" class="mb-30" alt="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <img src="assets/img/gallery/directory3.jpg"  class="mb-30"alt="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <img src="assets/img/gallery/directory4.jpg"  class="mb-30"alt="">
                                </div> -->
                            </div>
                        </div>

                        
                    </div>
                    <div class="col-lg-4">
                        <div class="text-center" style="padding-bottom: 20px;">
                        <?php 
                            if($bizDetails['business_approved'] == 0){
                                echo '<h4 style="color: red;">Waiting for Approval</h4>';
                            }
                        ?>
                        <?php 
                            if($username == $businessName || $username == 'admin'){
                                echo '
                                    <a href="add-article.php?id='.$bizDetails['id'].'" class="btn btn-primary">Add Article</a>';
                                echo '<a href="edit-profile.php?id='.$bizDetails['id'].'" class="btn btn-primary">Edit Profile</a>';
                            }
                        ?>
                        <?php
                        if($bizDetails['business_logo'] != ""){
                            echo '<img src="assets/img/business-logos/'.$bizDetails['business_logo'].'" style="width: 100%; box-shadow: 0px 6px 6px 0px rgb(2 25 65 / 15%); "/>';
                        }
                        ?>
                        </div>
                        <div class="map" style="box-shadow: 0px 6px 6px 0px rgb(2 25 65 / 15%);">
                        <iframe
                            width="100%"
                            height="300px"
                            frameborder="0" style="border:0"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD1yh93auk-lKvuQinI9mF71Soil7tWTOQ&q=<?php echo $bizDetails['business_street']?>"
                            allowfullscreen>
                        </iframe>
                        </div>
                        <div class="form-wrapper2 pt-30">
                            <div class="row ">
                                <div class="col-xl-12">
                                    <div class="small-tittle mb-30">
                                        <h2 style="color: #000; font-size: 24pt; font-weight: 800;">Contact</h2>
                                    </div>
                                </div>
                            </div>
                            <form id="contact-form2" method="POST">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-box user-icon mb-15">
                                            <input type="text" name="name" placeholder="Your name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-box email-icon mb-15">
                                            <input type="email" name="email" placeholder="Email address" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="">
                                            <textarea name="message" id="message" placeholder="Message" required></textarea>
                                        </div>
                                        <button class="submit-btn2" type="submit" name="contact">Send Message</button>
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