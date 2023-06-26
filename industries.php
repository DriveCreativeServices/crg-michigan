<?php



require 'includes/mysql.php';



require 'includes/login-logout.php';



if(isset($_POST['submit'])){

    $business = $_POST['business'];

    header('Location: company.php?company='.$business);

}



if(isset($_POST['filter'])){

    if(!isset($_POST['selectCity']) & !isset($_POST['selectIndustry'])){

        header('Location: industries.php');

    }

    else if(!isset($_POST['selectCity'])){

        $selectIndustry = $_POST['selectIndustry'];

        $selectCity = '';

    } else if(!isset($_POST['selectIndustry'])){

        $selectCity = $_POST['selectCity'];

        $selectIndustry = '';

    } else {

        $selectCity = $_POST['selectCity'];

        $selectIndustry = $_POST['selectIndustry'];

    }

    header('Location: industries.php?city='.$selectCity.'&industry='.$selectIndustry);

}



$filterByCity = "Find Your City";

$filterByIndustry = "Specific Industries";



$businessq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_approved` = 1");



if(isset($_GET['city']) && ($_GET['city'] != "")){

    $filterByCity = $_GET['city'];

    $cityDetailsq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_name` = '".$filterByCity."'");

    $cityDetails = mysqli_fetch_array($cityDetailsq);

    $cityId = $cityDetails['id'];

    $cityCount = mysqli_num_rows($cityDetailsq);

} else {

    $cityCount = 0;

}



if(isset($_GET['industry']) && ($_GET['industry'] != "")){

    $filterByIndustry = $_GET['industry'];

    $industryDetailsq = mysqli_query($con, "SELECT * FROM `industry` WHERE `industry_name` = '".$filterByIndustry."'");

    $industryDetails = mysqli_fetch_array($industryDetailsq);

    $industryId = $industryDetails['id'];

    $industryCount = mysqli_num_rows($industryDetailsq);

} else {

    $industryCount = 0;

}



if(isset($_GET['industry']) && isset($_GET['city'])){

    if($_GET['industry'] == ""){

        $businessq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_approved` = 1 AND `business_city_id` = $cityId");

    } else if ($_GET['city'] == ""){

        $businessq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_approved` = 1 AND `business_industry_id` = $industryId");

    } else {

        $businessq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_approved` = 1 AND `business_city_id` = $cityId AND `business_industry_id` = $industryId");

    }



}





?>



<!doctype html>

<html class="no-js" lang="zxx">

<head>

    <?php include 'includes/google-analytics-tag.php'; ?>

    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Directory | CRG Michigan - Connecting and Supporting Michigan Small Business</title>

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

            <div class="slider-height2 hero-bg1 hero-overly d-flex align-items-center">

                <div class="container">

                    <div class="row">

                        <div class="col-xl-12">

                            <div class="hero-caption hero-caption2">

                                <h2>BUSINESS PROFILE</h2>

                                <h2 style="font-weight: 500;">Neighborhood Business</h2>

                            </div>

                        </div>

                    </div>

                </div>

            </div> 

        </div>

        <!--  Hero area End -->

    

        <div style="background-color: #344FB4; padding: 10px 0px;">

            <div class="container">

                <!--Filter start -->

                    <form method="post">

                        <div class="row">

                            <div class="col-sm" style="margin: auto;">

                                <select name="selectCity" id="selectCity">

                                    <option value="0" selected="selected" disabled><?php echo $filterByCity ?></option>

                                    <?php

                

                                    $citiesq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_approved` = 1");

                                    while($cities = mysqli_fetch_array($citiesq)) {

                                        echo 

                                            '

                                                <option value="'.$cities['city_name'].'">'.$cities['city_name'].'</option>

                                            ';

                                    }

                                    ?>

                                </select>

                            </div>

                            <div class="col-sm" style="margin: auto;">

        

                                <select name="selectIndustry" id="selectIndustry">

                                    <option value="0" selected="selected" disabled><?php echo $filterByIndustry ?></option>

                                        <?php

                

                                        $industryq = mysqli_query($con, "SELECT * FROM `industry`");

                                        while($industry = mysqli_fetch_array($industryq)) {

                                            echo 

                                                '

                                                    <option value="'.$industry['industry_name'].'">'.$industry['industry_name'].'</option>

                                                ';

                                        }

                                        ?>

                                </select>

                            </div>

                            <div class="col-sm-1">

                                <button type="submit" style="background: none; border: none;" name="filter">

                                    <img src="assets/img/icon/filter.png" style="width: 70px;"/>

                                </button>

                            </div>

                        </div>

    

                    </form>

                </div>

            </div>

            <!-- Filter end-->



            <div class="container">

            <div class="count mb-25" style="padding-top: 25px;">

                <?php

                    if($cityCount > 0){

                        $count = $cityCount;

                    } else if ($industryCount > 0){

                        $count = $industryCount;

                    } else if ($cityCount > 0 && $industryCount > 0){

                        $count = $cityCount + $industryCount;

                    } else {

                        $businessCountq = mysqli_query($con, "SELECT COUNT(*) as bizCnt from `business` WHERE `business_approved` = 1");

                        $businessCountf = mysqli_fetch_array($businessCountq);

                        $businessCount = $businessCountf['bizCnt'];

                        $count = $businessCount;

                    }



                ?>

                <span><?php echo $count ?> Listing(s) are available</span>

            </div>

            <!-- Popular Directory Start -->

            <section class="popular-directorya-area">



                <?php



                // $businessq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_approved` = 1");

                while($business = mysqli_fetch_array($businessq)) {

                    // GET BIZ INDUSTRY

                    $bizIndustryq = mysqli_query($con, "SELECT * FROM `industry` WHERE `id` = '".$business['business_industry_id']."'");

                    $bizIndustry = mysqli_fetch_array($bizIndustryq);



                    $bizCityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$business['business_city_id']."'");

                    $bizCity = mysqli_fetch_array($bizCityq);

                    

                    $bizId = $business['id'];



                    if($business['business_logo'] == ''){

                       $displayBizLogo = "<img src='assets/img/gallery/directory1.jpg' alt='' style='width: 100%; height: 200px; object-fit: cover;'>";

                    } else {

                        $displayBizLogo = "<img src='assets/img/business-logos/".$business['business_logo']."' alt='' style='width: 100%; height: 200px; object-fit: cover;'>";

                    }

                    

                    if($business['business_email'] != ''){

                        $showEmail = '<a href="mailto:'.$business['business_email'].'" class="industry-contact-btn"><i class="far fa-envelope" style="margin-right: 10px;"></i>Email</a>';

                    } else {

                        $showEmail = '';

                    }

                    

                    if($business['business_phone'] != ''){

                        $showPhone = '<a href="tel:'.$business['business_phone'].'" class="industry-contact-btn" style="margin-bottom: 10px;"><i class="fas fa-phone-alt" style="margin-right: 10px;"></i>Call</a>';

                    } else {

                        $showPhone = '';

                    }

                    

                    $showFacebook = '';

                    $showInstagram = '';

                    $showLinkedin = '';

                    $showWebsite = '';

                    

                    if($business['business_facebook'] != ""){

                        $showFacebook = '

                            <div class="col-sm" style="padding: 0px; text-align: center;">

                                <a href="'.$business['business_facebook'].'" target="_blank"><img src="assets/img/icon/facebook.png" style="width: 35px;"/></a>

                            </div>';

                    }

                    

                    if($business['business_instagram'] != ""){

                        $showInstagram = '

                            <div class="col-sm" style="padding: 0px; text-align: center;">

                                <a href="'.$business['business_instagram'].'" target="_blank"><img src="assets/img/icon/instagram.png" style="width: 35px;"/></a>

                            </div>';

                    }

                    

                    if($business['business_linkedin'] != ""){

                        $showLinkedin = '

                            <div class="col-sm" style="padding: 0px; text-align: center;">

                                <a href="'.$business['business_linkedin'].'" target="_blank"><img src="assets/img/icon/linkedin.png" style="width: 35px;"/></a>

                            </div>';

                    }

                    

                    if($business['business_website'] != ""){

                        $showWebsite = '

                            <div class="col-sm" style="padding: 0px; text-align: center;">

                                <a href="'.$business['business_website'].'" target="_blank"><img src="assets/img/icon/website.png" style="width: 35px;"/></a>

                            </div>';

                    }

                    



                    echo 

                        '

                        <div class="properties properties2 pb-50">

                            <div class="properties-card">

                                <div class="row">

                                    <div class="col-sm">

                                        <a href="company.php?id='.$business['id'].'">

                                        '.$displayBizLogo.'

                                        </a>

                                    </div>

                                    <div class="col-sm" style="padding: 0px 30px;">

                                        <h3>

                                            <a href="company.php?id='.$business['id'].'" class="industry-link">'.$business['business_name'].' <span style="font-weight: 500; color: #000;">| '.$bizCity['city_name'].' | '.$bizIndustry['industry_name'].'</span></a>

                                        </h3>

                                        <div class="row" style="padding: 15px 0px;">

                                            <div class="col-sm-8">

                                                <p style="color: #000; font-weight: 500;">'.$business['business_about'].'</p>

                                            </div>

                                            <div class="col-sm-4">

                                                    <div>

                                                        '.$showPhone.'

                                                        '.$showEmail.'

                                                    </div>

                                                    <div class="row" style="padding-top: 10px;">

                                                        '.$showFacebook.'

                                                        '.$showInstagram.'

                                                        '.$showLinkedin.'

                                                        '.$showWebsite.'

                                                    </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        ';

                    }

                ?>

            </div>

            </section>

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



<!-- Get filter values -->

<script>

function getCity(){

var cityFilter = document.getElementById("selectCity").value;

console.log(cityFilter);

}



function getIndustry(){

var industryFilter = document.getElementById("selectIndustry").value;

console.log(industryFilter);

}



</script>



</body>

</html>