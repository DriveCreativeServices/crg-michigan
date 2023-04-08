<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if(isset($_POST['submit'])){
    $business = $_POST['business'];
    header('Location: company.php?company='.$business);
}

if(isset($_POST['filter'])){
    if(!isset($_POST['selectCity'])){
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

$filterByCity = "City";
$filterByIndustry = "Industry";

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
    <title>Industries | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
                                <h2>Industries</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--  Hero area End -->
        <!-- listing Area Start -->
        <div class="listing-area section-padding">
            <div class="container">
                <div class="row justify-content-between">
                    <!--? Left content -->
                    <div class="col-xl-3 col-lg-4 col-md-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="small-tittle mb-25">
                                    <h4>Filter</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Job Category Listing start -->
                        <div class="category-listing mb-50">
                            <!-- single one -->
                            <div class="single-listing">
                                <form method="post">
                                <!--Filter by City start -->
                                <div class="select-job-items2">
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
                                <!-- Filter by City End-->
                                <!-- Filter by Industry start -->
                                <div class="select-job-items2">
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
                                <!--  Filter by Industry End-->
                                <!-- 
                                <!- - Select km items start - ->
                                <div class="select-job-items2">
                                    <select name="select2">
                                        <option value="">Near 1 km</option>
                                        <option value="">2 km</option>
                                        <option value="">3 km</option>
                                        <option value="">4 km</option>
                                        <option value="">5 km</option>
                                        <option value="">6 km</option>
                                    </select>
                                </div>
                                <!- -  Select km items End- ->
                                <!- - select-Categories start - ->
                                <div class="select-Categories pt-80 pb-30">
                                    <div class="small-tittle2 mb-20">
                                        <h4>Price range</h4>
                                    </div>
                                    <label class="container">$50 - $150
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">$150 - $300
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">$300 - $500
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">$500 - $1000
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">$1000 - Above
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <!- - select-Categories End -->
                                <!-- select-Categories start -->
                                <!-- <div class="select-Categories">
                                    <div class="small-tittle2 mb-20">
                                        <h4>Tags</h4>
                                    </div>
                                    <label class="container">Wireless Internet
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Accepts Credit Cards
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Smoking Allowed
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Parking Street
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Coupons
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                                <!-- select-Categories End -->
                                <button type="submit" class="btn btn-primary" name="filter">Filter</button>
                                </form>
                            </div>
                        </div>
                        <!-- Job Category Listing End -->
                    </div>
                    <!--?  Right content -->
                    <div class="col-xl-8 col-lg-8 col-md-7">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="count mb-25">
                                    <?php
                                        if($cityCount > 0){
                                            $count = $cityCount;
                                        } else if ($industryCount > 0){
                                            $count = $industryCount;
                                        } else if ($cityCount > 0 && $industryCount > 0){
                                            $count = $cityCount + $industryCount;
                                        } else {
                                            $businessCountq = mysqli_query($con, "SELECT COUNT(*) as bizCnt from `business`");
                                            $businessCountf = mysqli_fetch_array($businessCountq);
                                            $businessCount = $businessCountf['bizCnt'];
                                            $count = $businessCount;
                                        }

                                        
                                    ?>
                                    <span><?php echo $count ?> Listing(s) are available</span>
                                </div>
                            </div>
                        </div>
                        <!-- Popular Directory Start -->
                        <section class="popular-directorya-area">
                            <?php
                                $bizNumCols = 2;
                                $bizRowCount = 0;
                            ?>
                            <div class="row">

                                <?php

                                // $businessq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_approved` = 1");
                                while($business = mysqli_fetch_array($businessq)) {
                                    // GET BIZ INDUSTRY
                                    $bizIndustryq = mysqli_query($con, "SELECT * FROM `industry` WHERE `id` = '".$business['business_industry_id']."'");
                                    $bizIndustry = mysqli_fetch_array($bizIndustryq);

                                    $bizCityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$business['business_city_id']."'");
                                    $bizCity = mysqli_fetch_array($bizCityq);

                                    if($business['business_logo'] == ''){
                                       $displayBizLogo = "<img src='assets/img/gallery/directory1.jpg' alt='' style='height: 200px; object-fit: cover;'>";
                                    } else {
                                        $displayBizLogo = "<img src='assets/img/business-logos/".$business['business_logo']."' alt='' style='height: 200px; object-fit: cover;'>";
                                    }

                                    $bizRowCount++;
                                    echo 
                                        '
                                            <div class="col-lg-6">
                                                <div class="properties properties2 pb-30">
                                                    <a href="company.php?id='.$business['id'].'" style="all: unset; cursor: pointer;">
                                                    <div class="properties-card">
                                                        <div class="properties-img overlay1">
                                                            '.$displayBizLogo.'
                                                            <!--<div class="img-text">
                                                                <span>Closed</span>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="far fa-heart"></i>
                                                            </div>
                                                            <div class="ratting">
                                                                <ul>
                                                                    <li><i class="fas fa-star"></i></li>
                                                                    <li><i class="fas fa-star"></i></li>
                                                                    <li><i class="fas fa-star"></i></li>
                                                                    <li><i class="fas fa-star"></i></li>
                                                                    <li><i class="fas fa-star"></i></li>
                                                                    <li><span>- 4.90 (230 Review)</span></li>
                                                                </ul>
                                                            </div>-->
                                                        </div>
                                                        <div class="properties-caption">
                                                            <h3>
                                                                <a href="company.php?id='.$business['id'].'">'.$business['business_name'].'</a>
                                                                <img src="assets/img/gallery/varified.png" alt="">
                                                            </h3>
                                                            <p style="color: #1a213d;"><i class="fas fa-map-marker-alt"></i>'.$bizCity['city_name'].'</p>
                                                        </div>
                                                        <div class="properties-footer d-flex justify-content-between align-items-center flex-wrap">
                                                            <div class="restaurant-name">
                                                                <!--<img src="assets/img/icon/restaurant-icon.svg" alt="">-->
                                                                <p style="color: #1a213d;">'.$bizIndustry['industry_name'].'</p>
                                                            </div>
                                                            <div class="contact">
                                                                <ul>
                                                                    <li><a href="tel:'.$business['business_phone'].'"><i class="fas fa-phone-alt"></i></a></li>
                                                                    <li><a href="mailto:'.$business['business_email'].'"><i class="far fa-envelope"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                        ';

                                    if($bizRowCount % $bizNumCols == 0) echo '</div><div class="row">';
                                }
                                ?>
                            </div>
                        </section>
                        <!-- Popular Directory End -->
                        <!--
                        <!- -Pagination Start  - ->
                        <div class="pagination-area text-center pt-10">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="single-wrap d-flex justify-content-center">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-start " id="myDIV">
                                                    <li class="page-item"><a class="page-link" href="#"><span class="ti-angle-left"></span></a></li>
                                                    <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">02</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                                                    <li class="page-item"><a class="page-link" href="#"><span class="ti-angle-right"></span></a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!- -Pagination End  - ->
                        -->
                    </div>
                </div>
            </div>
        </div>
        <!-- listing-area Area End -->
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