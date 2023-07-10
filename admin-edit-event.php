<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if(isset($_COOKIE['login'])){
    $username = $_COOKIE['login'];
} else {
    $username = '';
    header('Location: login.php');
}

$eventId = $_GET['id'];

$eventDetailsq = mysqli_query($con, "SELECT * FROM `event` WHERE `id` = '".$eventId."'");
$eventDetails = mysqli_fetch_array($eventDetailsq);

if(isset($_POST['update'])) {
    $newTitle = $_POST['new_title'];
    $newName = $_POST['new_name'];
    $newEmail = $_POST['new_email'];
    $newPhone = $_POST['new_phone'];
    $newAddress1 = $_POST['new_address1'];
    $newAddress2 = $_POST['new_address2'];
    $newCity = $_POST['new_city'];
    $newZip = $_POST['new_zip'];
    $newStart = $_POST['new_start'];
    $newEnd = $_POST['new_end'];
    $newLink = $_POST['new_link'];
    $newForCity = $_POST['new_for_city'];
    $newDescription = mysqli_real_escape_string($con, $_POST['new_desc']);
    $timestamp = date('Y-m-d H:i:s');

    $cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_name` = '$newForCity'");
    $cityidf = mysqli_fetch_array($cityidq);
    $cityId = $cityidf['id'];

    mysqli_query($con, "UPDATE `event` SET
        `name` = '$newName',
        `email` = '$newEmail',
        `phone` = '$newPhone',
        `address1` = '$newAddress1',
        `address2` = '$newAddress2',
        `city` = '$newCity',
        `zip` = '$newZip', 
        `title` = '$newTitle', 
        `description` = '$newDescription', 
        `start_date` = '$newStart',
        `end_date` = '$newEnd',
        `link` = '$newLink',
        `city_id` = '$cityId',
        `timestamp` = '$timestamp'
        WHERE `id` = '$eventId'") or die(mysqli_error($con));

    header("Location: event.php?id=".$eventId);
}

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Event | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
                                <h2>Edit Event</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--  Hero area End -->

        <div class="container">

        <!-- Add a event START-->
        <section>
            <div class="container" style="padding: 50px 50px;">
                <h2 style="padding-bottom: 25px;">Edit event</h2>
                <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="new_title" value="<?php echo $eventDetails['title'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sdesc">Your Name</label>
                            <input type="text" class="form-control" id="name" name="new_name" value="<?php echo $eventDetails['name'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="new_email" value="<?php echo $eventDetails['email'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="phone">Phone Number</label>
                      <input type="tel" class="form-control" name="new_phone" value="<?php echo $eventDetails['phone'] ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="address1">Address</label>
                    <input type="text" class="form-control" name="new_address1" value="<?php echo $eventDetails['address1'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="address2">Address 2</label>
                    <input type="text" class="form-control" name="new_address2" value="<?php echo $eventDetails['address2'] ?>">
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="city">City</label>
                      <input type="text" class="form-control" name="new_city" value="<?php echo $eventDetails['city'] ?>">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="state">State</label>
                      <select name="state" class="form-control">
                        <option value="MI">MI</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="zip">Zip</label>
                      <input type="text" class="form-control" name="new_zip" value="<?php echo $eventDetails['zip'] ?>">
                    </div>
                </div>
                <hr>
                <div class="row" style="padding-bottom: 15px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start-date">Start Date</label>
                            <input type="date" class="form-control" id="start-date" name="new_start" value="<?php echo $eventDetails['start_date'] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end-date">End Date</label>
                            <input type="date" class="form-control" id="end-date" name="new_end" value="<?php echo $eventDetails['end_date'] ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" name="new_link" value="<?php echo $eventDetails['link'] ?>">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div id="city">
                                <label for="city">City</label>
                                <select class="form-control" id="city" name="new_for_city" >
                                    <?php

                                        $articleCitiesq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_approved` = 1");
                                        while($articleCities = mysqli_fetch_array($articleCitiesq)) {

                                            echo 
                                                '
                                                <option value="'.$articleCities['city_name'].'">'.$articleCities['city_name'].'</option>
                                                ';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="body">Description</label>
                        <textarea class="form-control" id="description" rows="10" name="new_desc"><?php echo $eventDetails['description'] ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
        </section>
        <!-- Add a event END-->

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
            selector: '#description'
        });
    </script>
    </body>
</html>