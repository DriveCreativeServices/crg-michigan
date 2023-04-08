<?php

if(isset($_COOKIE['login'])){
  header('location: index.php');
}

//Start with the MySQL connection as in the previous example
require 'includes/mysql.php';

if(isset($_POST['submit'])){
//Get the values from the form submitted
$username = $_POST['username'];
$password = $_POST['password'];

//Look for a corresponding user
$result = mysqli_query($con, "SELECT * FROM `user` WHERE `user_name` = '$username' AND `user_password` ='".md5($password)."'");

$companyq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_name` = '$username'");
if($companyq->num_rows){
    $company = mysqli_fetch_array($companyq);
    $companyName = $company['business_name'];
} else {
    $companyName = '';
}

if($result->num_rows) {
   //user match
   setcookie('login', $username, time()+28800);
   if($username == 'admin' || $username == 'staff'){
    header('Location: admin.php');
   } else if ($username == $companyName) {
    header('Location: company.php?id='.$company['id']);
   } else {
       header('Location: index.php');
   }
}
else {
   //error, incorrect user or password
   echo '<script>alert("Incorrect username or password");</script>';
}
}

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - Connecting and Supporting Michigan Small Business</title>
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
                    <span>Login</span>
                    <p style="color: black;">Enter Login details to get access.</p>
                </div>
                <!-- Single Input Fields -->
                <form method="post">
                <div class="input-box">
                    <div class="single-input-fields">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Username / Email address">
                    </div>
                    <div class="single-input-fields">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter Password">
                    </div>
                </div>
                <p style="color: black; text-align: center;">Don't have an account? <a href="sign-up.php" style="color: #4db7fe;">Sign Up</a></p>
                <button type="submit" class="submit-btn3" name="submit">Login</button>
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