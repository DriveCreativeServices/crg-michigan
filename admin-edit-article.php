<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if(isset($_COOKIE['login'])){
    $username = $_COOKIE['login'];
} else {
    $username = '';
    header('Location: login.php');
}

$articleId = $_GET['id'];

$articleDetailsq = mysqli_query($con, "SELECT * FROM `article` WHERE `id` = '".$articleId."'");
$articleDetails = mysqli_fetch_array($articleDetailsq);
$articleTypeId = $articleDetails['type_id'];

if(isset($_POST['update'])) {
    $newTitle = $_POST['new_title'];
    $newDescription = $_POST['new_desc'];
    $newBody =  mysqli_real_escape_string($con,$_POST['new_body']);
    $timestamp = date('Y-m-d H:i:s');

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
        $new_img_name = $articleDetails['article_image'];
    }

    mysqli_query($con, "UPDATE `article` SET 
        `article_title` = '$newTitle', 
        `article_description` = '$newDescription', 
        `article_image` = '$new_img_name', 
        `article_body` = '$newBody', 
        `article_timestamp` = '$timestamp' 
        WHERE `id` = '$articleId'") or die(mysqli_error($con));

    header("Location: article.php?id=".$articleId);
}

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <?php include 'includes/google-analytics-tag.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Article | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
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
                                <h2>Edit Article</h2>
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
                <h2 style="padding-bottom: 25px;">Edit Article</h2>
                <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Article Title</label>
                            <input type="text" class="form-control" name="new_title" value="<?php echo $articleDetails['article_title'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="sdesc">Short Description</label>
                            <input type="text" class="form-control" name="new_desc" value="<?php echo $articleDetails['article_description'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="form-group">
                    Upload an image:
                    <input type="file" name="my_image" class="form-control">
                    <!-- <small>Image should be 400 x 400px and of the type .jpg, .jpeg, or .png</small> -->
                </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" rows="10" id="article-body" name="new_body" value="<?php echo $articleDetails['article_body'] ?>"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
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