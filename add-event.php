<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add Event | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
                                <h2>Add Event</h2>
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
                <h2 style="padding-bottom: 25px;">Add an Event</h2>
                <form method="post" action="scripts/add-event.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sdesc">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="phone">Phone Number</label>
                      <input type="tel" class="form-control" name="phone" placeholder="" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="address1">Address</label>
                    <input type="text" class="form-control" name="address1" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <label for="address2">Address 2</label>
                    <input type="text" class="form-control" name="address2" placeholder="">
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="city">City</label>
                      <input type="text" class="form-control" name="city" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="state">State</label>
                      <select name="state" class="form-control" required>
                        <!--<option value="AL">AL</option>-->
                        <!--<option value="AK">AK</option>-->
                        <!--<option value="AZ">AZ</option>-->
                        <!--<option value="AR">AR</option>-->
                        <!--<option value="CA">CA</option>-->
                        <!--<option value="CO">CO</option>-->
                        <!--<option value="CT">CT</option>-->
                        <!--<option value="DE">DE</option>-->
                        <!--<option value="FL">FL</option>-->
                        <!--<option value="GA">GA</option>-->
                        <!--<option value="HI">HI</option>-->
                        <!--<option value="ID">ID</option>-->
                        <!--<option value="IL">IL</option>-->
                        <!--<option value="IN">IN</option>-->
                        <!--<option value="IA">IA</option>-->
                        <!--<option value="KS">KS</option>-->
                        <!--<option value="KY">KY</option>-->
                        <!--<option value="LA">LA</option>-->
                        <!--<option value="ME">ME</option>-->
                        <!--<option value="MD">MD</option>-->
                        <!--<option value="MA">MA</option>-->
                        <option value="MI">MI</option>
                        <!--<option value="MN">MN</option>-->
                        <!--<option value="MS">MS</option>-->
                        <!--<option value="MO">MO</option>-->
                        <!--<option value="MT">MT</option>-->
                        <!--<option value="NE">NE</option>-->
                        <!--<option value="NV">NV</option>-->
                        <!--<option value="NH">NH</option>-->
                        <!--<option value="NJ">NJ</option>-->
                        <!--<option value="NM">NM</option>-->
                        <!--<option value="NY">NY</option>-->
                        <!--<option value="NC">NC</option>-->
                        <!--<option value="ND">ND</option>-->
                        <!--<option value="OH">OH</option>-->
                        <!--<option value="OK">OK</option>-->
                        <!--<option value="OR">OR</option>-->
                        <!--<option value="PA">PA</option>-->
                        <!--<option value="RI">RI</option>-->
                        <!--<option value="SC">SC</option>-->
                        <!--<option value="SD">SD</option>-->
                        <!--<option value="TN">TN</option>-->
                        <!--<option value="TX">TX</option>-->
                        <!--<option value="UT">UT</option>-->
                        <!--<option value="VT">VT</option>-->
                        <!--<option value="VA">VA</option>-->
                        <!--<option value="WA">WA</option>-->
                        <!--<option value="WV">WV</option>-->
                        <!--<option value="WI">WI</option>-->
                        <!--<option value="WY">WY</option>-->
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="zip">Zip</label>
                      <input type="text" class="form-control" name="zip" required>
                    </div>
                </div>
                <hr>
                <div class="row" style="padding-bottom: 15px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start-date">Start Date</label>
                            <input type="date" class="form-control" id="start-date" name="start-date" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end-date">End Date</label>
                            <input type="date" class="form-control" id="end-date" name="end-date" placeholder="" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="link">Link</label>
                        <input type="text" class="form-control" id="link" name="link" placeholder="">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div id="city">
                                <label for="city">City</label>
                                <select class="form-control" id="city" name="city" required>
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
                        <textarea class="form-control" id="description" rows="10" name="description" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Add Event</button>
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