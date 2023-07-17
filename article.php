<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

$articleID = $_GET['id'];

$articleDetailsq = mysqli_query($con, "SELECT * FROM `article` WHERE `id` = '$articleID'");
$articleDetails = mysqli_fetch_array($articleDetailsq);

$typeId = $articleDetails['type_id'];
$cityId = $articleDetails['city_id'];
$bizId = $articleDetails['business_id'];

$articleDate = date('F j, Y', strtotime($articleDetails['start_date']));
$articleBizID = $articleDetails['business_id'];
$articleCityID = $articleDetails['city_id'];
$articleTypeID = $articleDetails['type_id'];

if($articleDetails['article_image'] == ''){
  $displayArticleImage = "<img src='assets/img/gallery/directory1.jpg' alt='' style='width: 100%; height: 100%; object-fit: cover;'>";
} else {
  $displayArticleImage = "<img src='assets/img/article-images/".$articleDetails['article_image']."' alt='' style='width: 100%; height: 100%; object-fit: cover;'>";
}

$cityDetailsq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$cityId'");
$cityDetails = mysqli_fetch_array($cityDetailsq);

$bizDetailsq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '$articleBizID'");
$bizDetails = mysqli_fetch_array($bizDetailsq);

if(isset($_POST['newsletter'])){
  $email = $_POST['email'];

  $checkEmailq = mysqli_query($con, "SELECT COUNT(*) as emailcnt FROM `newsletter` WHERE `email` = '$email'");
  $checkEmail = mysqli_fetch_array($checkEmailq);

  if($checkEmail['emailcnt'] > 1){
      echo '<script>alert("This email is already signed up!");</script>';
  } else {
      mysqli_query($con, "INSERT INTO `newsletter` (`email`, `business_id` , `city_id`) VALUES ('$email', '$articleBizID', '$articleCityID')");
      echo '<script>alert("Thank you for signing up for our newsletter!");</script>';

  }
}

$metaTitle = strip_tags($articleDetails['article_title']);
$metaDescription = strip_tags($articleDetails['article_description']);

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
  <?php include 'includes/google-analytics-tag.php'; ?>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $metaTitle ?> | CRG Michigan - Connecting and Supporting Michigan Small Business</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/icon/favicon.png">

  <!-- ARTICLE METADATE FOR SOCIAL SHARING -->
  <meta property="og:title" content="<?php echo $metaTitle?>" />
  <meta property="og:image" content="assets/img/article-images/<?php echo $articleDetails['article_image']?>"/>
  <meta property="og:url" content="http://www.crgmichigan.com/article.php?id=<?php echo $articleID?>"/>
  <meta property="og:description" content="<?php echo $metaDescription?>"/>

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
        <h2><?php echo $articleDetails['article_title']?></h2>
      </div>
    </div>
  </div>
</div>
</div> 
</div>
<!--  Hero area End -->
<!-- Blog Area Start -->
<section class="blog_area single-post-area section-padding">
  <div class="container">
   <div class="row">
    <div class="col-lg-8 posts-list">
     <div class="single-post">
      <div class="feature-img">
       <?php echo $displayArticleImage?>
     </div>
     <div class="blog_details">
       <h2 style="color: #2d2d2d;"><?php echo $articleDetails['article_title'] ?></h2>
      <ul class="blog-info-link mt-3 mb-4">
        <li><a href="city.php?id=<?php echo $cityId?>"><i class="fa fa-city"></i>
          <?php 
            if($articleTypeID == 3){
              echo "".$cityDetails['city_name']." |  <i class='fa fa-clock'></i> ".$articleDate."</a>";
            } else if($articleTypeID == 2){
              echo "".$bizDetails['business_name']." |  <i class='fa fa-clock'></i> ".$articleDate."</a>";
            } else {
              echo "Place of Interest |  <i class='fa fa-clock'></i> ".$articleDate."</a>";
            }
            ?>
        </li>
        <!-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> -->
      </ul>
      <div class="excert">
        <?php echo $articleDetails['article_body']?>
      </div>
  </div>
</div>
<div class="navigation-top">
  <div class="d-sm-flex justify-content-between text-center">
   <div class="col-sm-4 text-center my-2 my-sm-0">
   </div>
    <ul class="social-icons">
      <li>Share Article: </li>
    <li><a href="http://www.facebook.com/sharer.php?u=http://crgmichigan.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="http://twitter.com/share?url=http://www.crgmichigan.com/article.php?id=<?php echo $articleDetails['article_title']?>&text=Check out this article from CRG Michigan: <?php echo $articleDetails['article_title']?>&hashtags=CRGMichigan,ConnectingMichigan,SmallBusiness" target="_blank"><i class="fab fa-twitter"></i></a></li>
  </ul>
</div>
</div>
</div>


<div class="col-lg-4">
 <div class="blog_right_sidebar">
    <?php 
        if($articleDetails['article_approved'] == 0){
            echo '<h4 style="color: red;">Waiting for Approval</h4>';
        }
    ?>
    <aside class="single_sidebar_widget popular_post_widget">
      <h3 class="widget_title" style="color: #2d2d2d;">Other Articles</h3>
      <?php

          if($typeId == 2){
            $articlesq = mysqli_query($con, "SELECT * FROM `article` WHERE `business_id` = '$articleBizID' && `start_date` < NOW() && `end_date` > NOW() ORDER BY `article_timestamp` DESC");
            $articleCount = mysqli_num_rows($articlesq);
            $count = 0;
            while($count < 5 && $articles = mysqli_fetch_array($articlesq)) {
              $date = date('F j, Y', strtotime($articles['start_date']));

              if($articles['article_image'] == ''){
                $displayArticleImage = "assets/img/gallery/directory1.jpg";
              } else {
                  $displayArticleImage = "assets/img/article-images/".$articles['article_image']."";
              }

              echo
              '
              <a href="article.php?id='.$articles['id'].'">
              <div class="media post_item" style="cursor: pointer;">
                <img src="'.$displayArticleImage.'" alt="'.$articles['article_title'].'" class="other-post-img">
                <div class="media-body">
                  <a href="article.php?id='.$articles['id'].'">
                    <h3 style="color: #2d2d2d;">'.$articles['article_title'].'</h3>
                  </a>
                  <p style="color: #2d2d2d;">'.$date.'</p>
              </div>
              </div>
              </a>
              ';

              $count++;
            }

            if($articleCount > 5){
              echo '<a href="more-articles.php?id='.$articles['id'].'" style="color: blue; text-decoration: underline;">Show More</a>';
            }
          }

          if($typeId == 3){
            $articlesq = mysqli_query($con, "SELECT * FROM `article` WHERE `city_id` = '$cityId' && `start_date` < NOW() && `end_date` > NOW() ORDER BY `article_timestamp` DESC");
            $articleCount = mysqli_num_rows($articlesq);
            $count = 0;
            while($count < 5 && $articles = mysqli_fetch_array($articlesq)) {
              $date = date('F j, Y', strtotime($articles['start_date']));

              if($articles['article_image'] == ''){
                $displayArticleImage = "assets/img/gallery/directory1.jpg";
              } else {
                  $displayArticleImage = "assets/img/article-images/".$articles['article_image']."";
              }

              echo
              '
              <a href="article.php?id='.$articles['id'].'">
              <button type="submit" name="submit" style="all: unset; cursor: pointer;">
              <input type="hidden" value="'.$articles['article_title'].'" name="article-title" >
              <div class="media post_item" style="cursor: pointer;">
                <img src="'.$displayArticleImage.'" alt="'.$articles['article_title'].'" class="other-post-img">
                <div class="media-body">
                  <a href="article.php?id='.$articles['id'].'">
                    <h3 style="color: #2d2d2d;">'.$articles['article_title'].'</h3>
                  </a>
                  <p style="color: #2d2d2d;">'.$date.'</p>
              </div>
              </button>
              </a>
              ';

              $count++;
            }

            if($articleCount > 5){
              echo '<a href="more-articles.php?id='.$articles['id'].'" style="color: blue; text-decoration: underline;">Show More</a>';
            }
          }

          if($typeId == 1){
            $articlesq = mysqli_query($con, "SELECT * FROM `article` WHERE `type_id` = '$typeId' && `start_date` < NOW() && `end_date` > NOW() ORDER BY `article_timestamp` DESC");
            $articleCount = mysqli_num_rows($articlesq);
            $count = 0;
            while($count < 5 && $articles = mysqli_fetch_array($articlesq)) {
              $date = date('F j, Y', strtotime($articles['start_date']));

              if($articles['article_image'] == ''){
                $displayArticleImage = "assets/img/gallery/directory1.jpg";
              } else {
                  $displayArticleImage = "assets/img/article-images/".$articles['article_image']."";
              }

              echo
              '
              <form method="post" action="scripts/article-redirect.php">
              <button type="submit" name="submit" style="all: unset; cursor: pointer;">
              <input type="hidden" value="'.$articles['article_title'].'" name="article-title" >
              <div class="media post_item" style="cursor: pointer;">
                <img src="'.$displayArticleImage.'" alt="'.$articles['article_title'].'" class="other-post-img">
                <div class="media-body">
                  <a href="article.php?id='.$articles['id'].'">
                    <h3 style="color: #2d2d2d;">'.$articles['article_title'].'</h3>
                  </a>
                  <p style="color: #2d2d2d;">'.$date.'</p>
              </div>
              </button>
              </form>
              ';

              $count++;
            }

            if($articleCount > 5){
              echo '<a href="more-articles.php?id='.$articles['id'].'" style="color: blue; text-decoration: underline;">Show More</a>';
            }
          }
        ?>
    </aside>
    <!-- <aside class="single_sidebar_widget newsletter_widget">
      <h4 class="widget_title" style="color: #2d2d2d;">Newsletter</h4>
      <form method="POST" action="#">
          <div class="form-group">
            <input type="email" class="form-control" onfocus="this.placeholder = ''"
            onblur="this.placeholder = 'Enter email'" placeholder='Enter email' name="email" required>
          </div>
        <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit" name="newsletter">Subscribe</button>
      </form>
    </aside> -->
  </div>
</div>
</div>
</div>
</section>
<!-- Blog Area End -->
</main>

<?php include 'includes/footer.php';?>
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
</body>
</html>