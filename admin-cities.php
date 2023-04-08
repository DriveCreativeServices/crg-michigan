<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if($username == 'staff' || $username == 'admin'){
    $isAllowed = true;
} else {
    header('Location: login.php');
}

$getAllCities = mysqli_query($con, "SELECT * FROM `city`");

$getLastCityIDq = mysqli_query($con, "SELECT * FROM `city` ORDER BY `id` DESC LIMIT 1");
$countOfCities = mysqli_num_rows($getAllCities);
if($countOfCities == 0){
    $lastCityID = 1;
} else {
$getLastCityID = mysqli_fetch_array($getLastCityIDq);
$lastCityID = $getLastCityID['id'] + 1;
}

// Add a city
if(isset($_POST['add-city'])){
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
        $new_img_name = "";
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
        $newsletter_new_img_name = "$lastCityID.pdf";
        $newsletter_img_upload_path = 'assets/img/city-featured-newsletter/'.$newsletter_new_img_name;
        move_uploaded_file($newsletter_tmp_name, $newsletter_img_upload_path);
    } else {
        $newsletter_new_img_name = "";
    }
    
    // INSERT INTO DB
    mysqli_query($con, "INSERT INTO `city` (`city_name`, `city_image`, `city_links`, `featured_newsletter`) VALUES ('$cityName', '$new_img_name', '$cityLinks', '$newsletter_new_img_name')");
    header("Location: admin-cities.php");
}

// Approve a city
if(isset($_POST['approve-city'])){
    $cityId = $_POST['city-id'];

    mysqli_query($con, "UPDATE `city` SET `city_approved` = 1 WHERE `id` = ".$cityId."");
    
    header("Location: admin-cities.php");
}

// Un-Approve a city
if(isset($_POST['unapprove-city'])){
    $cityId = $_POST['city-id'];

    mysqli_query($con, "UPDATE `city` SET `city_approved` = 0 WHERE `id` = ".$cityId."");
    
    header("Location: admin-cities.php");
}

// Delete a city
if(isset($_POST['delete-city'])){
    $cityId = $_POST['city-id'];
    
    mysqli_query($con, "DELETE FROM `city` WHERE `id` = ".$cityId."");
    header("Location: admin-cities.php");
}

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
                                <h2>Admin</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--  Hero area End -->

        <div class="container" style="padding: 50px 0px;">

            <section style="padding-bottom: 25px;">
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item" >
                <h2 class="accordion-header" id="flush-headingSeven">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                   <p class="btn btn-primary">Add a City</p>
                  </button>
                </h2>
                <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                      <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="body">City Name:</label>
                            <input type="text" class="form-control" id="city-name" name="city-name" required />
                        </div>
                        <div class="form-group">
                            Upload an image:
                            <input type="file" name="my_image" class="form-control" id="my_image">
                        </div>
                        <div class="form-group">
                            <label for="body">Links:</label>
                            <input type="text" class="form-control" id="city-links" name="city-links" required />
                            <small>Use a comma-separated list for multiple links. External links must contain "https://" or "http://"</small>
                        </div>
                            <div class="form-group">
                            Upload featured newsletter:
                            <input type="file" name="newsletter_image" class="form-control" id="newsletter_image">
                        </div>
                        <button type="submit" class="btn btn-primary" name="add-city">Add City</button>
                      </form>
                  </div>
                </div>
              </div>
            </div>
            </section>
            
            <h2>City Requests</h2>
            <table class="table" style="margin-bottom: 50px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>City Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                </tbody>
    
                <?php
                    $cityRequestq = mysqli_query($con, "SELECT * FROM `city_request`");
                    while($cityRequest = mysqli_fetch_array($cityRequestq)) {
                        echo 
                        '
                            <tr>
                                <td>'.$cityRequest['id'].'</td>
                                <td>'.$cityRequest['city_name'].'</td>
                                <td>'.$cityRequest['name'].'</td>
                                <td>'.$cityRequest['email'].'</td>
                                <td>'.$cityRequest['phone'].'</td>
                            </tr>
                        ';
                    }
                ?>
            </table>
        
           <h2>Current Cities</h2>
           <table class="table">
             <thead>
                <tr>
                    <th>ID</th>
                    <th>City Name</th>
                    <th>Image</th>
                    <th>Helpful Links</th>
                    <th>Featured Newsletter</th>
                    <th>Status</th>
                    <th></th>
                </tr>
             </thead>
             </tbody>
        
                <?php
                $cityq = mysqli_query($con, "SELECT * FROM `city`");
                while($city = mysqli_fetch_array($cityq)) {
                    if($city['city_approved'] == 1){
                        $status = 'Approved';
                        $approveBtn =
                        '
                            <form method="post">
                                <input type="hidden" name="city-id" value='.$city['id'].'>
                                <button type="submit" class="btn btn-warning" style="padding: 20px 35px; margin-bottom: 5px;" name="unapprove-city">Un-Approve</button>
                            </form>
                        ';
                    } else {
                        $status = 'Pending';
                        $approveBtn = 
                        '
                            <form method="post">
                                <input type="hidden" name="city-id" value='.$city['id'].'>
                                <button type="submit" class="btn btn-success" style="padding: 20px 35px; margin-bottom: 5px;" name="approve-city">Approve</button>
                            </form>
                        ';
                    }
                    
                    if($city['city_image'] != NULL){
                        $cityImage = 'View';
                    } else {
                        $cityImage = '';
                    }
                    
                    if($city['featured_newsletter'] != NULL){
                        $cityNewsletter = 'View';
                    } else {
                        $cityNewsletter = '';
                    }
                    
                    
                    echo
                    '
                        <tr>
                            <td>'.$city['id'].'</td>
                            <td><a href="city.php?id='.$city['id'].'" style="color: #4db7fe;">'.$city['city_name'].'</a></td>
                            <td><a href="assets/img/city-images/'.$city['city_image'].'" style="color: #4db7fe;">'.$cityImage.'</a></td>
                            <td>
                                <ul>
                                    ';
                                    if($city['city_links'] != NULL){
                                    $cityLinksArray = preg_split ("/\,/", $city['city_links']);
                                    $numCityLinks = count($cityLinksArray);
    
                                        for($i = 0; $i < $numCityLinks; $i++){
                                            echo '
                                            <li><a href="'.$cityLinksArray[$i].'" target="_blank" style="color: #4db7fe;">'.$cityLinksArray[$i].'</a></li>
                                            ';
                                        }
                                    }
                                    echo '
                                </ul>
                            </td>
                            <td><a href="assets/img/city-featured-newsletter/'.$city['featured_newsletter'].'" style="color: #4db7fe;">'.$cityNewsletter.'</a></td>
                            <td>'.$status.'</td>
                            <td>
                                <a href="admin-edit-city.php?id='.$city['id'].'" class="btn btn-primary" style="padding: 20px 35px; margin-bottom: 5px;">Edit</a>
                                '.$approveBtn.'
                                <form method="post">
                                    <input type="hidden" name="city-id" value='.$city['id'].'>
                                    <button type="submit" class="btn btn-danger" style="padding: 20px 35px;" name="delete-city">Delete</button>
                                </form>
                            </td>
                        </tr>
                    ';
                }
                ?>
            </table>

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

    <script>
        function displayBizSelect(){ 
            let type = document.getElementById('type').value;
            if (type == "place-of-interest") {
                document.getElementById("biz").style.display = "none";
                document.getElementById("article-city").style.display = "none";
            }
            if(type == "business"){
                document.getElementById("biz").style.display = "block";
                document.getElementById("article-city").style.display = "none";
            }
            if (type == "city") {
                document.getElementById("biz").style.display = "none";
                document.getElementById("article-city").style.display = "block";
            }
        }
    </script>
    </body>
</html>