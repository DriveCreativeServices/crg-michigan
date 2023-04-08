<?php

require 'mysql.php';

if(isset($_POST['submit'])){

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
            <div class="footer-area footer-padding">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-8">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-20">
                                    <!-- logo -->
                                    <div class="footer-logo mb-35">
                                        <a href="index.php"><img src="assets/img/logo/logo2_footer.png" alt="" height="100px;"></a>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>Find what you need. Where you need it.</p>
                                        </div>
                                    </div>
                                    <!-- social -->
                                    <div class="footer-social">
                                        <!-- <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="offset-xl-1 col-xl-2 col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Navigation</h4>
                                    <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="industries.php">Industries</a></li>
                                        <li><a href="community.php">Locations</a></li>
                                        <li><a href="about.php">About</a></li>
                                        <!-- <li><a href="#">Contact</a></li> -->
                                        <li><a href="login.php">Login</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Industries</h4>
                                    <ul>
                                        <?php

                                        $industriesAllowed = 5;
                                        $rowCount = 0;
                                    
                                        $industriesq = mysqli_query($con, "SELECT * FROM `industry`");
                                        while($industries = mysqli_fetch_array($industriesq)) {
                                            $rowCount++;
                                            if($rowCount == $industriesAllowed){
                                                break;
                                            } else {
                                            echo 
                                                '
                                                <li><a href="industries.php?city=&industry='.$industries['industry_name'].'">'.$industries['industry_name'].'</a></li>
                                                ';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle mb-10">
                                    <h4>Our Newsletter</h4>
                                    <p>Subscribe to our newsletter to get updates about local services and offers.</p>
                                </div>
                                <!-- Form -->
                                <div class="footer-form mb-20">
                                    <!-- <div id="mc_embed_signup"> -->
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" id="newsletter-form-email" placeholder="Enter your email"
                                                    class="placeholder hide-on-focus" required>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" name="submit" class="btn-no-hover" style="padding: 24px 35px;">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                            <!-- </div> -->
                        </div>
                    </div>
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
                            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Website by <a href="https://jacobjuszkowski.com" target="_blank">J2 Digital</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</footer>