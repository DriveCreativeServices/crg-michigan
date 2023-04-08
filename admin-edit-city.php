<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

$cityId = $_GET['id'];

$cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$cityId'");
$cityidf = mysqli_fetch_array($cityidq);

// Edit a city
if(isset($_POST['edit-city'])){
    $cityName = $_POST['city-name'];
    $cityLinks = $_POST['city-links'];
    
    // CITY IMAGE
    $img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $allowed_exs = array("jpg", "jpeg", "png"); 

    if (in_array($img_ex_lc, $allowed_exs)) {
        // Image 1
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = 'assets/img/city-images/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    } else {
        $new_img_name = $cityidf['city_image'];
    }
    
    // NEWSLETTER
    $newsletter_img_name = $_FILES['newsletter_image']['name'];
	$newsletter_img_size = $_FILES['newsletter_image']['size'];
	$newsletter_tmp_name = $_FILES['newsletter_image']['tmp_name'];
	$newsletter_error = $_FILES['newsletter_image']['error'];
    $newsletter_img_ex = pathinfo($newsletter_img_name, PATHINFO_EXTENSION);
    $newsletter_img_ex_lc = strtolower($newsletter_img_ex);

    $newsletter_allowed_exs = array("pdf"); 
    
    if (in_array($newsletter_img_ex_lc, $newsletter_allowed_exs)) {
        // Image 1
        $newsletter_new_img_name = "$cityId.pdf";
        $newsletter_img_upload_path = 'assets/img/city-featured-newsletter/'.$newsletter_new_img_name;
        move_uploaded_file($newsletter_tmp_name, $newsletter_img_upload_path);
    } else {
        $newsletter_new_img_name = $cityidf['featured_newsletter'];
    }
    
    // INSERT INTO DB
    mysqli_query($con, "UPDATE `city` SET `city_name` = '$cityName', `city_image` = '$new_img_name', `city_links` = '$cityLinks', `featured_newsletter` = '$newsletter_new_img_name' WHERE `id` = '$cityId'");
    header("Location: admin-cities.php");
}

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit <?php echo $cityidf['city_name']; ?> | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/icon/favicon.png">
    
        <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    
    <!-- CSS here -->
    <!--<link rel="stylesheet" href="assets/css/bootstrap.min.css">-->
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
                                <h1><?php echo $cityidf['city_name']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Hero Area End-->
        
        <div class="container" style="padding: 50px 0px;">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="body">City Name:</label>
                    <input type="text" class="form-control" id="city-name" name="city-name" value="<?php echo $cityidf['city_name']?>" />
                </div>
                <div class="form-group">
                    Upload an image:
                    <input type="file" name="my_image" class="form-control" id="my_image">
                </div>
                <div class="form-group">
                    <label for="body">Links:</label>
                    <input type="text" class="form-control" id="city-links" name="city-links" value="<?php echo $cityidf['city_links']?>" />
                    <small>Use a comma-separated list for multiple links. External links must contain "https://" or "http://"</small>
                </div>
                    <div class="form-group">
                    Upload featured newsletter:
                    <input type="file" name="newsletter_image" class="form-control" id="newsletter_image">
                </div>
                <button type="submit" class="btn btn-primary" name="edit-city">Save</button>
            </form>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>

<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
  crossorigin="anonymous"
></script>
    
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"
></script>

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