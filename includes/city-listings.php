<?php

require 'includes/mysql.php';

$cityId = $_GET['id'];

$cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$cityId'");
$cityidf = mysqli_fetch_array($cityidq);

?>

<!-- You Interested  Start-->
<section id="listings" class="popular-location section-padding section-bg">
            <div class="container" style="width: 100%;">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-40">
                            <h2>Listings</h2>
                            <p>Want to list something, click <a href="../add-listing.php" style="color: #1a213d;">here</a>.</p>
                        </div>
                    </div>
                </div>

            <?php
            $numCols = 3;
            $rowCount = 0;
            $colWidth = 12 / $numCols;
            ?>

            <div class="row">

            <?php

            $listingsq = mysqli_query($con, "SELECT * FROM `listing` WHERE `city_id` = '$cityId' && `listing_approved` = 1");
            $listingCount = mysqli_num_rows($listingsq);
            $count = 0;
            while($count < 3 && $listings = mysqli_fetch_array($listingsq)) {
                $rowCount++;

                if($listings['image'] == ''){
                    $displayListingImage = "<img src='assets/img/gallery/directory1.jpg' alt='' style='height: 200px; width: 100%; object-fit: cover;'>";
                 } else {
                     $displayListingImage = "<img src='assets/img/listing-images/".$listings['image']."' alt='' style='height: 200px; width: 100%; object-fit: cover;'>";
                 }

                echo 
                    '
                    <div class="col-md-'.$colWidth.'">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6">
                                <a href="listing.php?id='.$listings['id'].'">
                                <div class="single-location mb-20">
                                    <div class="location-img">
                                    '.$displayListingImage.'
                                    </div>
                                    <div class="location-details">
                                        <h4 style="color: white;">'.$listings['title'].'</h4>
                                        <h4 style="color: white;">$'.$listings['price'].'</h4>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    ';

                $count++;
                
                if($rowCount % $numCols == 0) echo '</div><div class="row">';
            }

            if($listingCount > 3){
                echo '<a href="listings.php?city='.$cityId.'" style="color: blue; text-decoration: underline; text-align: center;">Show More</a>';
              }

            ?>

                </div>
            </div>
        </section>
        <!--You Interested  End -->