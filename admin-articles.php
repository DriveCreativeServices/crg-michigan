<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if($username == 'staff' || $username == 'admin'){
    $isAllowed = true;
} else {
    header('Location: login.php');
}

$getAllArticles = mysqli_query($con, "SELECT * FROM `article`");

$getLastArticleIDq = mysqli_query($con, "SELECT * FROM `article` ORDER BY `id` DESC LIMIT 1");
$countOfArticles = mysqli_num_rows($getAllArticles);
if($countOfArticles == 0){
    $lastArticleID = 1;
} else {
$getLastArticleID = mysqli_fetch_array($getLastArticleIDq);
$lastArticleID = $getLastArticleID['id'] + 1;
}

// Add a article
if(isset($_POST['add'])){
    // ARTICLE FORM INPUTS
    $title = $_POST['title'];
    $description = $_POST['sdesc'];
    $type = $_POST['type'];
    $business = $_POST['biz'];
    $city = $_POST['article-city'];
    $body = mysqli_real_escape_string($con, $_POST['article-body']);
    $timestamp = date('Y-m-d H:i:s');

    // FIND ID for ARTICLE TYPE, BUSINESS, & CITY
    $typeidq = mysqli_query($con, "SELECT * FROM `article_type` WHERE `type` = '$type'");
    $typeidf = mysqli_fetch_array($typeidq);
    $typeId = $typeidf['id'];

    if($typeId != 2){
        $bizId = 0;
    } else {
        $bizidq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_name` = '$business'");
        $bizidf = mysqli_fetch_array($bizidq);
        $bizId = $bizidf['id'];
    }

    if($city == ""){
        $cityId = "";
    } else {
        $cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_name` = '$city'");
        $cityidf = mysqli_fetch_array($cityidq);
        $cityId = $cityidf['id'];
    }
    
    // Get next id for articles
    $articlesQ = mysqli_query($con, "SELECT * FROM `article` ORDER BY `id` DESC LIMIT 1;");
    $articles = mysqli_fetch_array($articlesQ);
    $nextArticleID = $articles['id'] + 1;
    
    
    // ARTICLE IMAGE
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
        $img_upload_path = 'assets/img/article-images/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    } else {
        $new_img_name = "";
    }

    // INSERT INTO DB
    mysqli_query($con, "INSERT INTO `article` (
        `article_title`, 
        `article_description`, 
        `type_id`, 
        `business_id`,
        `city_id`,
        `article_image`,
        `article_body`,
        `article_timestamp`
        ) VALUES (
        '$title',
        '$description',
        '$typeId',
        '$bizId',
        '$cityId',
        '$new_img_name',
        '$body',
        '$timestamp'
        )") or die(mysqli_error($con));
    header("Location: admin-articles.php");

}

// Approve a article
if(isset($_POST['approve'])){
    $articleId = $_POST['article-id'];

    mysqli_query($con, "UPDATE `article` SET `article_approved` = 1 WHERE `id` = ".$articleId."");
    
    header("Location: admin-articles.php");
}

// Un-Approve a article
if(isset($_POST['unapprove'])){
    $articleId = $_POST['article-id'];

    mysqli_query($con, "UPDATE `article` SET `article_approved` = 0 WHERE `id` = ".$articleId."");
    
    header("Location: admin-articles.php");
}

// Delete a city
if(isset($_POST['delete'])){
    $articleId = $_POST['article-id'];
    
    mysqli_query($con, "DELETE FROM `article` WHERE `id` = ".$articleId."");
    header("Location: admin-articles.php");
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
               <p class="btn btn-primary">Add an Article</p>
              </button>
            </h2>
            <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                  <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Article Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="sdesc">Short Description</label>
                                <input type="text" class="form-control" id="sdesc" name="sdesc" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-bottom: 15px;">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="type">Article Type</label>
                                <select class="form-control" id="type" name="type" onchange="displayBizSelect()" required>
                                    <option value="0" selected="selected" disabled>Select a type...</option>
                                    <?php
                                    
    
                                        $typesq = mysqli_query($con, "SELECT * FROM `article_type`");
                                        while($types = mysqli_fetch_array($typesq)) {
    
                                            echo 
                                                '
                                                <option value="'.$types['type'].'">'.$types['type'].'</option>
                                                ';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <div id="biz">
                                    <label for="biz">For Business</label>
                                    <select class="form-control biz" id="biz" name="biz">
                                        <?php
    
                                            $bizq = mysqli_query($con, "SELECT * FROM `business`");
                                            while($biz = mysqli_fetch_array($bizq)) {
    
                                                echo 
                                                    '
                                                    <option value="'.$biz['business_name'].'">'.$biz['business_name'].'</option>
                                                    ';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div id="article-city">
                                    <label for="article-city">For City</label>
                                    <select class="form-control" id="article-city" name="article-city">
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
                                Upload an image:
                                <input type="file" name="my_image" class="form-control" id="my_image">
                                <!-- <small>Image should be 400 x 400px and of the type .jpg, .jpeg, or .png</small> -->
                            </div>
                    </div>
    
    
                    <div class="row">
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" id="article-body" rows="10" name="article-body"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add">Add Article</button>
                    </form>
              </div>
            </div>
          </div>
        </div>
        </section>
        
        
       <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>For</th>
                    <th>Description</th>
                    <th>Timestamp</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            </tbody>
    
            <?php
                $articleq = mysqli_query($con, "SELECT * FROM `article`");
                while($article = mysqli_fetch_array($articleq)) {
                    $typeq = mysqli_query($con, "SELECT * FROM `article_type` WHERE `id` = '".$article['type_id']."'");
                    $type = mysqli_fetch_array($typeq);
                    
                    if($type['id'] == 2){
                        $businessq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '".$article['business_id']."'");
                        $business = mysqli_fetch_array($businessq);
                        $for = $business['business_name'];
                    } else if ($type['id'] == 3){
                        $cityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$article['city_id']."'");
                        $city = mysqli_fetch_array($cityq);
                        $for = $city['city_name'];
                    } else {
                        $for = "";
                    }
                    
                    if($article['article_approved'] == 1){
                        $status = 'Approved';
                        $approveBtn =
                        '
                            <form method="post">
                                <input type="hidden" name="article-id" value='.$article['id'].'>
                                <button type="submit" class="btn btn-warning" style="padding: 20px 35px;" name="unapprove">Un-Approve</button>
                            </form>
                        ';
                    } else {
                        $status = 'Pending';
                        $approveBtn = 
                        '
                            <form method="post">
                                <input type="hidden" name="article-id" value='.$article['id'].'>
                                <button type="submit" class="btn btn-success" style="padding: 20px 35px;" name="approve">Approve</button>
                            </form>
                        ';
                    }
    
                    echo 
                    '
                        <tr>
                            <form method="post">
                            <td><a href="article.php?id='.$article['id'].'" style="color: #4db7fe;">'.$article['article_title'].'</a></td>
                            <td>'.$type['type'].'</td>
                            <td>'.$for.'</td>
                            <td>'.$article['article_description'].'</td>
                            <td>'.$article['article_timestamp'].'</td>
                            <td>'.$status.'</td>
                            <td>
                                <a href="admin-edit-article.php?id='.$article['id'].'" class="btn btn-primary" style="padding: 20px 35px; margin-bottom: 5px;">Edit</a>
                                '.$approveBtn.'
                                <form method="post">
                                    <input type="hidden" name="article-id" value='.$article['id'].'>
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