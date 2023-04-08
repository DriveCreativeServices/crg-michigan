<!-- Top Destination -->
<section class="great-stuffs section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-40">
                            <h2>Top Industries</h2>
                        </div>
                    </div>
                </div>
                <div class="row">

                <?php

                $industriesq = mysqli_query($con, "SELECT `business_industry_id` FROM `business` WHERE `business_city_id` = '$cityId'");
                $count = 0;
                while($count < 6 && $industries = mysqli_fetch_array($industriesq)) {
                    $industryDetailsq = mysqli_query($con, "SELECT * FROM `industry` WHERE `id` = '". $industries['business_industry_id']."'");
                    $industryDetails = mysqli_fetch_array($industryDetailsq);
                    echo 
                    '
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                            <div class="single-location mb-30 text-center">
                                <div class="location-img">
                                    <img src="assets/img/gallery/topDesti1.png" alt="">
                                    <div class="location-details">
                                        <h4><a href="http://localhost/crg-michigan/industries.php?city='.$cityName.'&industry='.$industryDetails['industry_name'].'">Explore<i class="fas fa-angle-right"></i></a></h4>
                                    </div>
                                </div>
                                <h3><a href="http://localhost/crg-michigan/industries.php?city='.$cityName.'&industry='.$industryDetails['industry_name'].'">'.$industryDetails['industry_name'].'</a></h3>
                            </div>
                    </div>
                    ';
                }

                ?>
                    <!-- <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <div class="single-location mb-30 text-center">
                            <div class="location-img">
                                <img src="assets/img/gallery/topDesti1.png" alt="">
                                <div class="location-details">
                                    <h4><a href="#">Explore<i class="fas fa-angle-right"></i></a></h4>
                                </div>
                            </div>
                            <h3><a href="#">New York</a></h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <div class="single-location mb-30 text-center">
                            <div class="location-img">
                                <img src="assets/img/gallery/topDesti2.png" alt="">
                                <div class="location-details">
                                    <h4><a href="#">Explore<i class="fas fa-angle-right"></i></a></h4>
                                </div>
                            </div>
                            <h3><a href="#">Toronto</a></h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <div class="single-location mb-30 text-center">
                            <div class="location-img">
                                <img src="assets/img/gallery/topDesti3.png" alt="">
                                <div class="location-details">
                                    <h4><a href="#">Explore<i class="fas fa-angle-right"></i></a></h4>
                                </div>
                            </div>
                            <h3><a href="#">Thailand</a></h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <div class="single-location mb-30 text-center">
                            <div class="location-img">
                                <img src="assets/img/gallery/topDesti4.png" alt="">
                                <div class="location-details">
                                    <h4><a href="#">Explore<i class="fas fa-angle-right"></i></a></h4>
                                </div>
                            </div>
                            <h3><a href="#">Paris</a></h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <div class="single-location mb-30 text-center">
                            <div class="location-img">
                                <img src="assets/img/gallery/topDesti5.png" alt="">
                                <div class="location-details">
                                    <h4><a href="#">Explore<i class="fas fa-angle-right"></i></a></h4>
                                </div>
                            </div>
                            <h3><a href="#">Dhaka</a></h3>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <div class="single-location mb-30 text-center">
                            <div class="location-img">
                                <img src="assets/img/gallery/topDesti6.png" alt="">
                                <div class="location-details">
                                    <h4><a href="#">Explore<i class="fas fa-angle-right"></i></a></h4>
                                </div>
                            </div>
                            <h3><a href="#">Rome</a></h3>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <!-- Top Destination End -->