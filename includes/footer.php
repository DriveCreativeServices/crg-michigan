<?php

require 'mysql.php';

if(isset($_POST['newsletter-submit'])){

    $email = $_POST['email'];

    $checkEmailq = mysqli_query($con, "SELECT COUNT(*) as emailcnt FROM `newsletter` WHERE `email` = '$email'");
    $checkEmail = mysqli_fetch_array($checkEmailq);

    if($checkEmail['emailcnt'] > 0){
        echo '<script>alert("This email is already signed up!");</script>';
    } else {
        mysqli_query($con, "INSERT INTO `newsletter` (`email`) VALUES ('$email')");
        echo '<script>alert("Thank you for signing up for our newsletter!");</script>';

    }
}

?>

<footer>
        <div class="footer-wrapper gray-bg">
            <div class="footer-area" style="padding: 50px 0px;">
                <div class="container" style="text-align: center;">
                    <div class="footer-logo mb-35">
                        <a href="index.php"><img src="assets/img/logo/logo2_footer.png" alt="" height="100px;"></a>
                    </div>
                    <div class="footer-tittle">
                        <div class="footer-pera">
                            <p>Find what you need. Where you need it.</p>
                        </div>
                    </div>
                    <div>
                        <a href="index.php" style="padding-left: 10px; text-decoration: underline;">Home</a></li>
                        <a href="industries.php" style="padding-left: 10px; text-decoration: underline;">Industries</a>
                        <a href="community.php" style="padding-left: 10px; text-decoration: underline;">Communities</a>
                        <a href="about.php" style="padding-left: 10px; text-decoration: underline;">About</a>
                        <a href="login.php" style="padding-left: 10px; text-decoration: underline;">Login</a>
                    </div>
            </div>
        </div>
    </div>
    <!-- footer-bottom area -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="footer-border">
                <div class="row">
                    <div class="col-xl-12 ">
                        <div class="footer-copy-right text-center">
                            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Platform by 
                                <a href="https://jacobjuszkowski.github.io" target="_blank"><img src="../assets/img/j2logo.png" style="height: 25px; padding-right: 5px;"></a>
                                <a href="https://drivecreativeservices.com" target="_blank"><img src="../assets/img/drivelogo.png" style="height: 25px; padding-right: 5px;"></a>
                                <a href="https://orb.solutions" target="_blank"><img src="../assets/img/orblogo.png" style="height: 25px;"></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</footer>