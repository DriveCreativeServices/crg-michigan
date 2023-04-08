<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if(isset($_POST['submit'])){
    $business = $_POST['business'];
    header('Location: company.php?company='.$business);
}

if(isset($_GET['city']) && ($_GET['city'] != "")){
    $cityId = $_GET['city'];
    $cityDetailsq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$cityId'");
    $cityDetails = mysqli_fetch_array($cityDetailsq);
    $cityCount = mysqli_num_rows($cityDetailsq);
} else {
    $cityCount = 0;
}

if(isset($_POST['filter'])){
    $selectCity = $_POST['selectCity'];
    header('Location: listings.php?city='.$selectCity.'');
}

$filterByCity = "City";

$listingsq = mysqli_query($con, "SELECT * FROM `listing` WHERE `listing_approved` = 1 && `city_id` = $cityId");


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
                                <h2>Listings</h2>
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
                                        <option value="0" selected="selected" disabled><?php echo $cityDetails['city_name']; ?></option>
                                        <?php

                                        $citiesq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_approved` = 1");
                                        while($cities = mysqli_fetch_array($citiesq)) {
                                            echo 
                                                '
                                                    <option value="'.$cities['id'].'">'.$cities['city_name'].'</option>
                                                ';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- Filter by City End-->
                                
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
                                        $listingCountq = mysqli_query($con, "SELECT COUNT(*) as listingCnt from `listing` WHERE `city_id` = $cityId");
                                            $listingCountf = mysqli_fetch_array($listingCountq);
                                        $listingCount = $listingCountf['listingCnt'];
                                        $count = $listingCount;

                                        
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
                                while($listing = mysqli_fetch_array($listingsq)) {
                                    
                                    $listingCityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$listing['city_id']."'");
                                    $listingCity = mysqli_fetch_array($listingCityq);

                                    if($listing['image'] == ''){
                                       $displayListingLogo = "<img src='assets/img/gallery/directory1.jpg' alt='' style='height: 200px; object-fit: cover;'>";
                                    } else {
                                        $displayListingLogo = "<img src='assets/img/listing-images/".$listing['image']."' alt='' style='height: 200px; object-fit: cover;'>";
                                    }

                                    $bizRowCount++;
                                    echo 
                                        '
                                            <div class="col-lg-6">
                                                <div class="properties properties2 pb-30">
                                                    <a href="listing.php?id='.$listing['id'].'" style="all: unset; cursor: pointer;">
                                                    <div class="properties-card">
                                                        <div class="properties-img overlay1">
                                                            '.$displayListingLogo.'
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
                                                                <a href="company.php?id='.$listing['id'].'">'.$listing['title'].'</a>
                                                                <img src="assets/img/gallery/varified.png" alt="">
                                                            </h3>
                                                            <p style="color: #1a213d;"><i class="fas fa-map-marker-alt"></i>'.$listingCity['city_name'].'</p>
                                                        </div>
                                                        <div class="properties-footer d-flex justify-content-between align-items-center flex-wrap">
                                                            <div class="restaurant-name">
                                                                <!--<img src="assets/img/icon/restaurant-icon.svg" alt="">-->
                                                                <p style="color: #1a213d;">$'.$listing['price'].'</p>
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