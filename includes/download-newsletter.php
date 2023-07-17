<?php

require 'includes/mysql.php';

$cityId = $_GET['id'];

$cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$cityId'");
$cityidf = mysqli_fetch_array($cityidq);

// $featuredNewsletterCountq = mysqli_query($con, "SELECT COUNT(*) as cnt FROM `city_featured_newsletter` WHERE `city_id` = '$cityId'");
// $featuredNewsletterCount = mysqli_fetch_array($featuredNewsletterCountq);
// $newsletterCount = $featuredNewsletterCount['cnt'];


if($cityidf['featured_newsletter'] != NULL){
    $featuredNewsletterFile = $cityidf['featured_newsletter'];
    $showDownloadBtn = '
        <div style="display: grid;">
        <embed src="assets/img/city-featured-newsletter/'.$featuredNewsletterFile.'" />
        <a href="assets/img/city-featured-newsletter/'.$featuredNewsletterFile.'" target="_blank" class="btn btn-primary" style="margin-top: 10px; width: 300px; height: 50px; background-color: #7d9f6c; border-radius: 30px; border: 0px; padding-top: 13px;">Download</a>
        </div>
        ';
} else {
    $showDownloadBtn = '<p style="color: black;">There is no newsletter available.</p>';
}


?>

<!-- You Interested  Start-->
<section class="popular-location section-padding section-bg">
            <!--<div class="container">-->
                <div class="row">
                    <div class="col-sm-7">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-40">
                            <h2>Read the Latest</br>Community Newsletter</h2>
                            <!--<p>Download to view current information about your city.</p>-->
                            <!--<?php echo $showDownloadBtn; ?>-->
                            
                        </div>
                    </div>
                    <div class="col-sm-5" style="justify-content: center; display: flex; align-items: center;">
                       <?php echo $showDownloadBtn; ?>
                    </div>
                </div>
            <!--</div>-->
        </section>
        <!--You Interested  End -->