<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if(isset($_COOKIE['login'])){
    $username = $_COOKIE['login'];
} else {
    $username = '';
    header('Location: login.php');
}

$bizId = $_GET['id'];

$bizDetailsq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '".$bizId."'");
$bizDetails = mysqli_fetch_array($bizDetailsq);
$businessName = $bizDetails['business_name'];

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add Article | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
            <div class="slider-height2 hero-bg2 hero-overly d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-caption hero-caption2">
                                <h2>Add Article</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--  Hero area End -->

        <div class="container">

        <!-- Add a article START-->
        <section>
            <div class="container" style="padding: 50px 50px;">
                <h2 style="padding-bottom: 25px;">Add an Article</h2>
                <form method="post" action="scripts/business-add-article.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Article Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="sdesc">Short Description</label>
                            <input type="text" class="form-control" id="sdesc" name="sdesc" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 15px;">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="type">Article Type</label>
                            <select class="form-control" name="type" required>
                                <option value="2">Business</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <div id="biz" style="display: block;">
                                <label for="biz">For Business</label>
                                <select class="form-control biz" name="biz">
                                    <option value="<?php echo $bizId?>"><?php echo $businessName?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="form-group">
                            Upload an image:
                            <input type="file" name="my_image" class="form-control" id="my_image">
                            <!-- <small>Image should be 400 x 400px and of the type .jpg, .jpeg, or .png</small> -->
                        </div>
                </div>


                <div class="row">
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" id="article-body" rows="10" name="article-body"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="article-submit">Create</button>
                </form>
            </div>
        </section>
        <!-- Add a article END-->

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

    <!-- Text area library -->
    <script src='tinymce/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: '#article-body'
        });
    </script>
    </body>
</html>