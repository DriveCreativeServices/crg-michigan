<?php

require 'includes/mysql.php';

$cityId = $_GET['id'];

// if(isset($_POST['submit'])){
//     $businessID = $_POST['business-id'];

// }

?>

<!-- Popular Directory Start -->
<section id="businesses" class="popular-directorya-area section-padding fix">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-35">
                            <h2>Featured Businesses</h2>
                            <p>Find a service in your city</p>
                        </div>
                    </div>
                </div>
                <div class="directory-active">
                <?php
                    $getCityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$cityId."'");
                    $getCity = mysqli_fetch_array($getCityq);


                    $businessq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_city_id` = '".$getCity['id']."' AND `business_approved` = 1");
                    while($business = mysqli_fetch_array($businessq)) {
                        // GET BIZ INDUSTRY
                        $bizIndustryq = mysqli_query($con, "SELECT * FROM `industry` WHERE `id` = '".$business['business_industry_id']."'");
                        $bizIndustry = mysqli_fetch_array($bizIndustryq);

                        $bizCityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$business['business_city_id']."'");
                        $bizCity = mysqli_fetch_array($bizCityq);

                        if($business['business_logo'] == ''){
                            $displayBizLogo = "<img src='../assets/img/gallery/directory1.jpg' alt='' style='height: 100%;'>";
                         } else {
                             $displayBizLogo = "<img src='../assets/img/business-logos/".$business['business_logo']."' alt='' style='height: 100%;'>";
                         }

                        echo 
                            '
                                    <div class="properties pb-20">
                                        <form method="post">
                                            <a href="../company.php?id='.$business['id'].'" style="all: unset; cursor: pointer;">
                                            <div class="properties-card">
                                                <div class="properties-img overlay1" style="height: 120px;">
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
                                                        <a href="../company.php?id='.$business['id'].'">'.$business['business_name'].'</a>
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
                                            <input type="hidden" name="business" value="'.$business['business_name'].'">
                                            <input type="hidden" name="business-id" value="'.$business['id'].'">
                                            </a>
                                        </form>
                                    </div>
                            ';
                    }
                    ?>
                </div>
            </div>

            <!-- Want To work -->
            <section class="container">
                <div class="row justify-content-center ">
                    <div class="col-xl-8 col-lg-9">
                        <div class="wantToWork-area w-padding2 mt-30">
                            <div class="pera">
                                <h2>Do you want to find more?</h2>
                                    <?php
                                        $businessCountq = mysqli_query($con, "SELECT COUNT(*) as bizCnt from `business`");
                                        $businessCountf = mysqli_fetch_array($businessCountq);

                                        $businessCount = $businessCountf['bizCnt'];
                                    ?>
                                <p><?php echo $businessCount ?> listing(s) for you on our list.</p>
                            </div>
                            <div class="linking">
                                <a href="industries.php" class="btn wantToWork-btn">Explore More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Want To work End -->
        </section>
        <!-- Popular Directory End -->