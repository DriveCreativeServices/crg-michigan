<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if($username == 'staff' || $username == 'admin'){
    $isAllowed = true;
} else {
    header('Location: login.php');
}

$getAllBusinesses = mysqli_query($con, "SELECT * FROM `business`");

$getLastBusinessIDq = mysqli_query($con, "SELECT * FROM `business` ORDER BY `id` DESC LIMIT 1");
$countOfBusinesses = mysqli_num_rows($getAllBusinesses);
if($countOfBusinesses == 0){
    $lastBusinessID = 1;
} else {
$getLastBusinessID = mysqli_fetch_array($getLastBusinessIDq);
$lastBusinessID = $getLastBusinessID['id'] + 1;
}

// Add a business
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $industry = $_POST['industry'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $google = $_POST['google'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];
    $about = $_POST['about'];

    $img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];


    $industryidq = mysqli_query($con, "SELECT * FROM `industry` WHERE `industry_name` = '$industry'");
    $industryidf = mysqli_fetch_array($industryidq);
    if($industryidf == null){
        mysqli_query($con, "INSERT INTO `industry` (
            `industry_name`
            ) VALUES (
            '$industry'
            )") or die(mysqli_error($con));
        echo '<script>alert("Industry successfully created!");</script>';
        $newindustryidq = mysqli_query($con, "SELECT * FROM `industry` WHERE `industry_name` = '$industry'");
        $newindustryidf = mysqli_fetch_array($newindustryidq);
        $industryid = $newindustryidf['id'];
    } else {
        $industryid = $industryidf['id'];
    }

    $cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_name` = '$city'");
    $cityidf = mysqli_fetch_array($cityidq);
    if($cityidf == null){
        mysqli_query($con, "INSERT INTO `city` (
            `city_name`
            ) VALUES (
            '$city'
            )") or die(mysqli_error($con));
        echo '<script>alert("City successfully created!");</script>';
        $newcityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_name` = '$city'");
        $newcityidf = mysqli_fetch_array($newcityidq);
        $cityid = $newcityidf['id'];
    } else {
        $cityid = $cityidf['id'];
    }

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);


    $allowed_exs = array("jpg", "jpeg", "png"); 

    if (in_array($img_ex_lc, $allowed_exs)) {
        // Image 1
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = 'assets/img/business-logos/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    } else {
        $new_img_name = "";
    }

    mysqli_query($con, "INSERT INTO `business` (
        `business_name`, 
        `business_industry_id`, 
        `business_city_id`, 
        `business_street`,
        `business_phone`,
        `business_email`,
        `business_website`,
        `business_about`,
        `business_logo`,
        `business_approved`
        ) VALUES (
        '$name',
        '$industryid',
        '$cityid',
        '$street',
        '$email',
        '$phone',
        '$website',
        '$about',
        '$new_img_name',
        1
        )") or die(mysqli_error($con));

        // Generate random password for the business
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $genPassword = md5($randomString);

    // GET BUSINESS ID FOR BUSINESS THAT WAS JUST CREATED 
    $bizq = mysqli_query($con, "SELECT * FROM `business` ORDER BY id DESC LIMIT 1");
    $biz = mysqli_fetch_array($bizq);
    $bizId = $biz['id'];

    // INSERT SOCIAL MEDIA LINKS
    mysqli_query($con, "INSERT INTO `business_social_media` (
        `business_id`,
        `social_media_site`,
        `social_media_link` 
    ) VALUES (
        '$bizId',
        'Google',
        '$google'
    )");

    mysqli_query($con, "INSERT INTO `business_social_media` (
        `business_id`,
        `social_media_site`,
        `social_media_link` 
    ) VALUES (
        '$bizId',
        'Facebook',
        '$facebook'
    )");

    mysqli_query($con, "INSERT INTO `business_social_media` (
        `business_id`,
        `social_media_site`,
        `social_media_link` 
    ) VALUES (
        '$bizId',
        'Instagram',
        '$instagram'
    )");

    mysqli_query($con, "INSERT INTO `business_social_media` (
        `business_id`,
        `social_media_site`,
        `social_media_link` 
    ) VALUES (
        '$bizId',
        'Twitter',
        '$twitter'
    )");
    
    mysqli_query($con, "INSERT INTO `user` (`user_name`, `user_password`, `user_is_business`, `business_id`) VALUES ('$name', '$genPassword', 1, $bizId)");
    // mail($email, "CRG Michigan Login Information", "Username: ".$name." \n Password: ".$randomString."");
    header("Location: admin-businesses.php");
}

// Approve a business
if(isset($_POST['approve'])){
    $businessId = $_POST['business-id'];

    mysqli_query($con, "UPDATE `business` SET `business_approved` = 1 WHERE `id` = ".$businessId."");
    header("Location: admin-businesses.php");
}

// Un-Approve a business
if(isset($_POST['unapprove'])){
    $businessId = $_POST['business-id'];

    mysqli_query($con, "UPDATE `business` SET `business_approved` = 0 WHERE `id` = ".$businessId."");
    header("Location: admin-businesses.php");
}

// Approve change request
if(isset($_POST['approve-change-request'])){
    $businessId = $_POST['business-id'];
    $businessRequestId = $_POST['business-request-id'];
    $newName = $_POST['new_biz_name'];
    $newIndustry = $_POST['new_industry'];
    $newAddress = $_POST['new_address'];
    $newCity = $_POST['new_city'];
    
    $bizDetailsq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '$businessId'");
    $bizDetails = mysqli_fetch_array($bizDetailsq);
    $currentBizName = $bizDetails['business_name'];

    $bizEmail = $bizDetails['business_email'];
    
    $bizIndustryId = $bizDetails['business_industry_id'];
    $bizCityId = $bizDetails['business_city_id'];
    
    $industryDetailsq = mysqli_query($con, "SELECT * FROM `industry` WHERE `id` = '$bizIndustryId'");
    $industryDetails = mysqli_fetch_array($industryDetailsq);
    $industryName = $industryDetails['industry_name'];
    
    $cityDetailsq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$bizCityId'");
    $cityDetails = mysqli_fetch_array($cityDetailsq);
    $cityName = $cityDetails['city_name'];
    
    if($newName != $currentBizName){
        mysqli_query($con, "UPDATE `business` SET `business_name` = '$newName' WHERE `id` = '$businessId'");
    }
    
    // Add logic for adding new industry or city if they do not exist
    $industryidq = mysqli_query($con, "SELECT * FROM `industry` WHERE `industry_name` = '$newIndustry'");
    $industryidf = mysqli_fetch_array($industryidq);
    if($newIndustry != $industryName){
        if($industryidf == null){
            mysqli_query($con, "INSERT INTO `industry` (
                `industry_name`
                ) VALUES (
                '$industry'
                )") or die(mysqli_error($con));
            echo '<script>alert("Industry successfully created!");</script>';
            $newindustryidq = mysqli_query($con, "SELECT * FROM `industry` WHERE `industry_name` = '$industry'");
            $newindustryidf = mysqli_fetch_array($newindustryidq);
            $industryid = $newindustryidf['id'];
        } else {
            $industryid = $industryidf['id'];
        }
        mysqli_query($con, "UPDATE `business` SET `business_industry_id` = '$industryid' WHERE `id` = '$businessId'");
    }
    
    if($newAddress != $bizDetails['business_street']){
        mysqli_query($con, "UPDATE `business` SET `business_street` = '$newAddress' WHERE `id` = '$businessId'");
    }

    $cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_name` = '$newCity'");
    $cityidf = mysqli_fetch_array($cityidq);
    if($newCity != $cityName){
        if($cityidf == null){
            mysqli_query($con, "INSERT INTO `city` (
                `city_name`
                ) VALUES (
                '$city'
                )") or die(mysqli_error($con));
            echo '<script>alert("City successfully created!");</script>';
            $newcityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_name` = '$city'");
            $newcityidf = mysqli_fetch_array($newcityidq);
            $cityid = $newcityidf['id'];
        } else {
            $cityid = $cityidf['id'];
        }
        mysqli_query($con, "UPDATE `business` SET `business_city_id` = '$cityid' WHERE `id` = '$businessId'");
    }

    mysqli_query($con, "DELETE FROM `business_change_request` WHERE `id` = '$businessRequestId'");    
    mail($bizEmail, "Change Request Approved", "Your CRG Business information has been updated. Please visit your business profile on https://crgmichigan.com.");
    
    
}

// Deny change request
if(isset($_POST['deny-change-request'])){
    $businessId = $_POST['business-id'];
    $businessRequestId = $_POST['business-request-id'];
    
    $bizDetailsq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '$businessId'");
    $bizDetails = mysqli_fetch_array($bizDetailsq);
    $bizEmail = $bizDetails['business_email'];
    
    mysqli_query($con, "DELETE FROM `business_change_request` WHERE `id` = '$businessRequestId'"); 
    mail($bizEmail, "Change Request Denied", "After review, your submission has unfortunately been declined. Aspects of your submission do not uphold our standards or guidelines. The Community Resource Guide of Michigan and Drive Creative Services LLC do not guarantee submissions of any kind will be posted. All submissions are thoroughly reviewed to determine if the content aligns with our guidelines, brand, and values. If you would like more information on why your submission was not approved, you can contact info@drivecreativeservices.com.");
    header("Location: admin-businesses.php");
}

// Delete a business
if(isset($_POST['delete'])){
    $businessId = $_POST['business-id'];
    
    mysqli_query($con, "DELETE FROM `business` WHERE `id` = ".$businessId."");
    header("Location: admin-businesses.php");
    
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

        
        <!-- Requested Cities -->
        <section id="approve-event" style="padding-bottom: 25px;">
        <a href="business-registration.php" class="btn btn-primary">Add a Business</a>
        <!-- <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item" >
            <h2 class="accordion-header" id="flush-headingSeven">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
               <p class="btn btn-primary">Add a Business</p>
              </button>
            </h2>
            <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                  <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="industry">Industry</label>
                                <input type="text" list="industry" class="form-control" name="industry" required>
                                <datalist id="industry">
                                    <?php
    
    
                                        $industriesq = mysqli_query($con, "SELECT * FROM `industry`");
                                        while($industries = mysqli_fetch_array($industriesq)) {
    
                                            echo 
                                                '
                                                <option value="'.$industries['industry_name'].'">'.$industries['industry_name'].'</option>
                                                ';
                                        }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="street">Street Address</label>
                                <input type="text" class="form-control" id="street" name="street" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" list="city" class="form-control" name="city" required>
                                <datalist id="city">
                                    <?php
    
                                        $citiesq = mysqli_query($con, "SELECT * FROM `city`");
                                        while($cities = mysqli_fetch_array($citiesq)) {
    
                                            echo 
                                                '
                                                <option value="'.$cities['city_name'].'">'.$cities['city_name'].'</option>
                                                ';
                                        }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" class="form-control" id="website" name="website" placeholder="">
                            </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            Upload your logo:
                            <input type="file" name="my_image" class="form-control" id="my_image">
                            <small>Image should be 400 x 400px and of the type .jpg, .jpeg, or .png</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="google">Google+ Link</label>
                                <input type="text" class="form-control" id="google" name="google" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook">Facebook Link</label>
                                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="instagram">Instagram Link</label>
                                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="twitter">Twitter Link</label>
                                <input type="text" class="form-control" id="twitter" name="twitter" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="about">About</label>
                            <textarea class="form-control" id="about" rows="5" name="about"></textarea>
                        </div>
                    </div>
    
                    <button type="submit" class="btn btn-primary" name="add">Add Business</button>
                </form>
              </div>
            </div>
          </div>
        </div> -->
        </section>
        
        <h2>Change Requests</h2>
        <table class="table" style="margin-bottom: 50px;">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Industry</th>
                    <th>Street Address</th>
                    <th>City</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            </tbody>

            <?php
                $businessRequestq = mysqli_query($con, "SELECT * FROM `business_change_request`");
                while($businessRequest = mysqli_fetch_array($businessRequestq)) {
                    
                    $bizId = $businessRequest['biz_id'];

                    $bizDetailsq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '$bizId'");
                    $bizDetails = mysqli_fetch_array($bizDetailsq);
                    
                    // GET BIZ INDUSTRY
                    $bizIndustryq = mysqli_query($con, "SELECT * FROM `industry` WHERE `id` = '".$bizDetails['business_industry_id']."'");
                    $bizIndustry = mysqli_fetch_array($bizIndustryq);
                    
                    // GET BIZ CTIY
                    $bizCityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$bizDetails['business_city_id']."'");
                    $bizCity = mysqli_fetch_array($bizCityq);

                    $bizNameTest = $businessRequest['new_name'];

                    echo 
                    '
                        <tr>
                            <td>'.$bizDetails['business_name'].' -> '.$bizNameTest.'</td>
                            <td>'.$bizIndustry['industry_name'].' -> '.$businessRequest['new_industry'].'</td>
                            <td>'.$bizDetails['business_street'].' -> '.$businessRequest['new_address'].'</td>
                            <td>'.$bizCity['city_name'].' -> '.$businessRequest['new_city'].'</td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="business-id" value='.$bizDetails['id'].'>
                                    <input type="hidden" name="business-request-id" value='.$businessRequest['id'].'>
                                    <input type="hidden" name="new_biz_name" value="'.$businessRequest['new_name'].'">
                                    <input type="hidden" name="new_industry" value="'.$businessRequest['new_industry'].'">
                                    <input type="hidden" name="new_address" value="'.$businessRequest['new_address'].'">
                                    <input type="hidden" name="new_city" value="'.$businessRequest['new_city'].'">
                                    <button type="submit" class="btn btn-success" style="padding: 20px 35px;" name="approve-change-request">Approve</button>
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="business-id" value='.$bizDetails['id'].'>
                                    <input type="hidden" name="business-request-id" value='.$businessRequest['id'].'>
                                    <button type="submit" class="btn btn-danger" style="padding: 20px 35px;" name="deny-change-request">Deny</button>
                                </form>
                            </td>
                        </tr>
                    ';
                }
            ?>
        </table>
        
        
       <table class="table">
                    <thead>
                        <tr>
                            <th>Business Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <!--<th>Address</th>-->
                            <!--<th>City</th>-->
                            <!--<th>Industry</th>-->
                            <!--<th>Website</th>-->
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    </tbody>

            <?php
                $businessq = mysqli_query($con, "SELECT * FROM `business`");
                while($business = mysqli_fetch_array($businessq)) {
                    // GET BIZ INDUSTRY
                    $bizIndustryq = mysqli_query($con, "SELECT * FROM `industry` WHERE `id` = '".$business['business_industry_id']."'");
                    $bizIndustry = mysqli_fetch_array($bizIndustryq);

                    // GET BIZ CITY
                    $bizCityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$business['business_city_id']."'");
                    $bizCity = mysqli_fetch_array($bizCityq);
                    
                    if($business['business_approved'] == 1){
                        $status = 'Approved';
                        $approveBtn =
                        '
                            <form method="post">
                                <input type="hidden" name="business-id" value='.$business['id'].'>
                                <button type="submit" class="btn btn-warning" style="padding: 20px 35px;" name="unapprove">Un-Approve</button>
                            </form>
                        ';
                    } else {
                        $status = 'Pending';
                        $approveBtn = 
                        '
                            <form method="post">
                                <input type="hidden" name="business-id" value='.$business['id'].'>
                                <button type="submit" class="btn btn-success" style="padding: 20px 35px;" name="approve">Approve</button>
                            </form>
                        ';
                    }

                    echo 
                    '
                        <tr>
                            <form method="post">
                            <td><a href="company.php?id='.$business['id'].'" style="color: #4db7fe;">'.$business['business_name'].'</a></td>
                            <td>'.$business['business_phone'].'</td>
                            <td>'.$business['business_email'].'</td>
                            <!--<td>'.$business['business_street'].'</td>
                            <td><input type="text" name="city" value="'.$bizCity['city_name'].'"></td>
                            <td><input type="text" name="industry" value="'.$bizIndustry['industry_name'].'"></td>
                            <td>'.$business['business_website'].'</td>-->
                            <td>'.$status.'</td>
                            <td>'.$approveBtn.'</td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="business-id" value='.$business['id'].'>
                                    <button type="submit" class="btn btn-danger" style="padding: 20px 35px;" name="delete">Delete</button>
                                </form>
                            </td>
                            </form>
                        </tr>
                    ';
                }
            ?>
            </table>
        
        <!-- Requested Cities -->
        

        

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