<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if($username == 'staff' || $username == 'admin'){
    $isAllowed = true;
} else {
    header('Location: login.php');
}

$getAllObituaries= mysqli_query($con, "SELECT * FROM `obituary`");

$getLastObituaryIDq = mysqli_query($con, "SELECT * FROM `obituary` ORDER BY `id` DESC LIMIT 1");
$countOfObituaries= mysqli_num_rows($getAllObituaries);
if($countOfObituaries == 0){
    $lastObituaryID = 1;
} else {
$getLastObituaryID = mysqli_fetch_array($getLastObituaryIDq);
$lastObituaryID = $getLastObituaryID['id'] + 1;
}

// Add a obituary
if(isset($_POST['add'])){
// ARTICLE FORM INPUTS
    $deceasedName = $_POST['deceased-name'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $description = $_POST['description'];
    $timestamp = date('Y-m-d H:i:s');

    $cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_name` = '$city'");
    $cityidf = mysqli_fetch_array($cityidq);
    $cityId = $cityidf['id'];
    
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
        $img_upload_path = 'assets/img/obituary-images/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    } else {
        $new_img_name = "";
    }

    // INSERT INTO DB
    mysqli_query($con, "INSERT INTO `obituary` (
        `deceased_name`, 
        `name`,
        `email`,
        `phone`,
        `address1`,
        `address2`,
        `city`,
        `state`,
        `zip`,
        `city_id`,
        `image`,
        `description`,
        `timestamp`
        ) VALUES (
        '$deceasedName',
        '$name',
        '$email',
        '$phone',
        '$address1',
        '$address2',
        '$city',
        '$state',
        '$zip',
        '$cityId',
        '$new_img_name',
        '$description',
        '$timestamp'
        )") or die(mysqli_error($con));
    header("Location: admin-obituaries.php");

}

// Approve a listing
if(isset($_POST['approve'])){
    $obituaryId = $_POST['obituary-id'];

    mysqli_query($con, "UPDATE `obituary` SET `obituary_approved` = 1 WHERE `id` = ".$obituaryId."");
    header("Location: admin-obituaries.php");
}

// Un-Approve a listing
if(isset($_POST['unapprove'])){
    $obituaryId = $_POST['obituary-id'];

    mysqli_query($con, "UPDATE `obituary` SET `obituary_approved` = 0 WHERE `id` = ".$obituaryId."");
    header("Location: admin-obituaries.php");
}

// Delete a listing
if(isset($_POST['delete'])){
    $obituaryId = $_POST['obituary-id'];
    
    $obituaryCreatorq = mysqli_query($con, "SELECT * FROM `obituary` WHERE `id` = ".$obituaryId."");
    $obituaryCreator = mysqli_fetch_array($obituaryCreatorq);
    
    $obituaryEmail = $obituaryCreator['email'];
    
    mail($obituaryEmail, 'Obituary Declined', 'Your obituary has been declined. Please refer to our <a href="http://crgmichigan.com/about.php">about</a> page for details on our community rules and guidelines.');
    
    mysqli_query($con, "DELETE FROM `obituary` WHERE `id` = ".$obituaryId."");
    header("Location: admin-obituaries.php");
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
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item" >
            <h2 class="accordion-header" id="flush-headingSeven">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
               <p class="btn btn-primary">Add a Obituary</p>
              </button>
            </h2>
            <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                  <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Deceased's Name</label>
                                <input type="text" class="form-control" id="deceased-name" name="deceased-name" placeholder="" required>
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
                          <label for="email">Your Email</label>
                          <input type="email" class="form-control" name="email" placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="phone">Your Phone Number</label>
                          <input type="tel" class="form-control" name="phone" placeholder="" required>
                        </div>
                      </div>
                      <hr>
                        <div class="form-group">
                            <label for="title">Funeral Home Name</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="" required>
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
                    <div class="row" style="padding-bottom: 15px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                Upload an image:
                                <input type="file" name="my_image" class="form-control" id="my_image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div id="city">
                                    <label for="city">Where should this obituary be posted?</label>
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
                    <button type="submit" class="btn btn-primary" name="add">Add Obituary</button>
                    </form>
              </div>
            </div>
          </div>
        </div>
        </section>
        
        
       <table class="table">
        <thead>
            <tr>
                <th>Deceased's Name</th>
                <th>Submitter's Name</th>
                <th>Status</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        </tbody>

        <?php
            $obituaryq = mysqli_query($con, "SELECT * FROM `obituary`");
            while($obituary = mysqli_fetch_array($obituaryq)) {
                $cityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$obituary['city_id']."'");
                $city = mysqli_fetch_array($cityq);
                
                if($obituary['obituary_approved'] == 1){
                    $status = 'Approved';
                    $approveBtn =
                    '
                        <form method="post">
                            <input type="hidden" name="obituary-id" value='.$obituary['id'].'>
                            <button type="submit" class="btn btn-warning" style="padding: 20px 35px;" name="unapprove">Un-Approve</button>
                        </form>
                    ';
                } else {
                    $status = 'Pending';
                    $approveBtn = 
                    '
                        <form method="post">
                            <input type="hidden" name="obituary-id" value='.$obituary['id'].'>
                            <button type="submit" class="btn btn-success" style="padding: 20px 35px;" name="approve">Approve</button>
                        </form>
                    ';
                }

                echo 
                '
                    <tr>
                        <td><a href="listing.php?id='.$obituary['id'].'" style="color: #1a213d;">'.$obituary['deceased_name'].'</a></td>
                        <td>'.$obituary['name'].'</td>
                        <td>'.$status.'</td>
                        <td>'.$approveBtn.'</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="obituary-id" value='.$obituary['id'].'>
                                <button type="submit" class="btn btn-danger" style="padding: 20px 35px;" name="delete">Delete</button>
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