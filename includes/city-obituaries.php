<?php

require 'includes/mysql.php';

$cityId = $_GET['id'];

$cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$cityId'");
$cityidf = mysqli_fetch_array($cityidq);

?>

<!-- You Interested  Start-->
<section id="obituaries" class="popular-location section-padding section-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-40">
                            <h2>Obituaries</h2>
                            <p>Want to create an obituary, click <a href="../add-obituary.php" style="color: #1a213d;">here</a>.</p>
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

            $listingsq = mysqli_query($con, "SELECT * FROM `obituary` WHERE `city_id` = '$cityId' && `obituary_approved` = 1");
            $listingCount = mysqli_num_rows($listingsq);
            $count = 0;
            while($count < 3 && $listings = mysqli_fetch_array($listingsq)) {
                $rowCount++;

                if($listings['image'] == ''){
                    $displayListingImage = "<img src='assets/img/gallery/directory1.jpg' alt='' style='height: 200px; width: 100%; object-fit: cover;'>";
                 } else {
                     $displayListingImage = "<img src='assets/img/obituary-images/".$listings['image']."' alt='' style='height: 200px; width: 100%; object-fit: cover;'>";
                 }

                echo 
                    '
                    <div class="col-md-'.$colWidth.'">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6">
                                <a href="obituary.php?id='.$listings['id'].'">
                                <div class="single-location mb-20">
                                    <div class="location-img">
                                    '.$displayListingImage.'
                                    </div>
                                    <div class="location-details">
                                        <h4 style="color: white;">'.$listings['deceased_name'].'</h4>
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
                echo '<a href="obituaries.php?city='.$cityId.'" style="color: blue; text-decoration: underline; text-align: center;">Show More</a>';
              }

            ?>

                </div>
            </div>
        </section>
        <!--You Interested  End -->