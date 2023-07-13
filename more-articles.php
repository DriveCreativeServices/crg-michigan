<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

$articleId = $_GET['id'];

$articleDetailsq = mysqli_query($con, "SELECT * FROM `article` WHERE `id` = '$articleId'");
$articleDetails = mysqli_fetch_array($articleDetailsq);

$typeId = $articleDetails['type_id'];
$cityId = $articleDetails['city_id'];
$bizId = $articleDetails['business_id'];


?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Articles | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
    <main>
        <?php include 'includes/header.php'; ?>
        <!-- Hero Area Start-->
        <div class="slider-area hero-bg1">
            <div class="single-slider hero-overly  slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-11">
                            <!-- Hero Caption -->
                            <div class="hero-caption pt-10">
                                <h1>Articles</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Hero Area End-->

        <!-- List of Cities Start -->
        <div class="container" style="padding: 50px 15px;">
            <?php
            $numCols = 2;
            $rowCount = 0;
            $colWidth = 12 / $numCols;
            ?>

            <div class="row" style="padding: 0px 0px 0px 0px;">

            <?php

            if($typeId == 2){
                $articlesq = mysqli_query($con, "SELECT * FROM `article` WHERE `business_id` = '$bizId' && `start_date` < NOW() && `end_date` > NOW() ORDER BY `article_timestamp` DESC" );
                while($articles = mysqli_fetch_array($articlesq)) {
                    $rowCount++;

                    if($articles['article_image'] == ''){
                        $displayArticleImage = "<img src='assets/img/gallery/directory1.jpg' alt='' style='width: 100%; height: 300px; object-fit: contain;'>";
                    } else {
                        $displayArticleImage = "<img src='assets/img/article-images/".$articles['article_image']."' alt='' style='width: 100%; height: 300px; object-fit: cover;'>";
                    }

                    echo 
                        '
                        <div class="col-md-'.$colWidth.'" style="margin-bottom: 60px;">
                        <a href="article.php?id='.$articles['id'].'">
                                '.$displayArticleImage.'             
                                <h3 class="article-image-title">'.$articles['article_title'].'</h3>              
                        </a>
                            
                        </div>
                        ';
                    
                    if($rowCount % $numCols == 0) echo '</div><div class="row" style="padding: 12.5px 0px 0px 0px;">';
                }
            }
            if($typeId == 3){
                $articlesq = mysqli_query($con, "SELECT * FROM `article` WHERE `city_id` = '$cityId' && `start_date` < NOW() && `end_date` > NOW() ORDER BY `article_timestamp` DESC" );
                while($articles = mysqli_fetch_array($articlesq)) {
                    $rowCount++;

                    if($articles['article_image'] == ''){
                        $displayArticleImage = "<img src='assets/img/gallery/directory1.jpg' alt='' style='width: 100%; height: 300px; object-fit: cover;'>";
                    } else {
                        $displayArticleImage = "<img src='assets/img/article-images/".$articles['article_image']."' alt='' style='width: 100%; height: 300px; object-fit: cover;'>";
                    }

                    echo 
                        '
                        <div class="col-md-'.$colWidth.'">
                        <a href="article.php?id='.$articles['id'].'">
                                '.$displayArticleImage.'             
                                <h3 class="article-image-title">'.$articles['article_title'].'</h3>              
                        </a>
                            
                        </div>
                        ';
                    
                    if($rowCount % $numCols == 0) echo '</div><div class="row" style="padding: 12.5px 0px 0px 0px;">';
                }
            }
            if($typeId == 1){
                $articlesq = mysqli_query($con, "SELECT * FROM `article` WHERE `type_id` = '$typeId' && `start_date` < NOW() && `end_date` > NOW() ORDER BY `article_timestamp` DESC" );
                while($articles = mysqli_fetch_array($articlesq)) {
                    $rowCount++;

                    if($articles['article_image'] == ''){
                        $displayArticleImage = "<img src='assets/img/gallery/directory1.jpg' alt='' style='width: 100%; height: 300px; object-fit: cover;'>";
                    } else {
                        $displayArticleImage = "<img src='assets/img/article-images/".$articles['article_image']."' alt='' style='width: 100%; height: 300px; object-fit: cover;'>";
                    }

                    echo 
                        '
                        <div class="col-md-'.$colWidth.'">
                        <a href="article.php?id='.$articles['id'].'">
                                '.$displayArticleImage.'             
                                <h3 class="article-image-title">'.$articles['article_title'].'</h3>              
                        </a>
                            
                        </div>
                        ';
                    
                    if($rowCount % $numCols == 0) echo '</div><div class="row" style="padding: 12.5px 0px 0px 0px;">';
                }
            }
            
            

            ?>
            </div>
        <!-- Container End -->
        </div>
        <!-- List of Cities END -->

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