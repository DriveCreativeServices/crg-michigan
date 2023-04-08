<?php

if(isset($_COOKIE['login'])){
  header('location: index.php');
}

//Start with the MySQL connection as in the previous example
require 'includes/mysql.php';

if(isset($_POST['submit'])){

	$email = $_POST["email"];
	$password = md5($_POST["pwd"]);
	$passwordConfirm = md5($_POST["pwd2"]);

	$emailcheckq = mysqli_query($con,"SELECT COUNT(*) as cnt FROM `user` WHERE `user_name`='$email'");
	$emailcheck = mysqli_fetch_array($emailcheckq);


	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script>alert('Please enter a valid email address');</script>";
	} else if ($password !== $passwordConfirm) {
		echo "<script>alert('Passwords do not match');</script>";
	} else if ($emailcheck['cnt'] > 0) {
	    echo "<script>alert('An account with that email already exists!');</script>";
	} else {
        mysqli_query($con,"INSERT INTO `user` (`user_name`, `user_password`) VALUES('$email','$password')");
        setcookie('login', $email, time()+3600);
        mail($email, "Welcome to CRG!", "Thank you for creating an account at CRG, The Communit Resource Guide. Be sure to visit our <a href='http://crgmichigan.com/about.php'>about</a> page to review our community rules and guidelines! ");
        mail('info@drivecreativeservices.com', "New User", "$email has created an account!");
        header('Location:index.php');

	}
    };


?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign Up - Connecting and Supporting Michigan Small Business</title>
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

    <main class="login-bg">
        <!-- login Area Start -->
        <div class="login-form-area">
            <div class="login-form">
                <!-- Login Heading -->
                <div class="login-heading">
                    <span>Sign Up</span>
                    <p style="color: black;">Enter Login details to get access.</p>
                </div>
                <!-- Single Input Fields -->
                <form method="post">
                <div class="input-box">
                    <div class="single-input-fields">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Email address" required>
                    </div>
                    <div class="single-input-fields">
                        <label>Password</label>
                        <input type="password" name="pwd" placeholder="Enter Password" required>
                    </div>
                    <div class="single-input-fields">
                        <label>Confirm Password</label>
                        <input type="password" name="pwd2" placeholder="Re-type Password" required>
                    </div>
                </div>
                <!-- form Footer -->
                <div class="login-footer">
                    <button type="submit" class="submit-btn3" name="submit">Sign Up</button>
                </div>
                </form>
            </div>
        </div>
        <!-- login Area End -->
    </main>

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