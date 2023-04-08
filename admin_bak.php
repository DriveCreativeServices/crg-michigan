<?php

require 'includes/mysql.php';

require 'includes/login-logout.php';

if($username == 'staff' || $username == 'admin'){
    $isAllowed = true;
} else {
    header('Location: login.php');
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

        <div class="container" style="padding: 100px 0px;">

        <!-- Add a company START-->
        <div class="row" style="padding-bottom: 25px;">
            <div class="col-sm">
                <a href="admin-cities.php" class="btn btn-primary" style="width: 100%; height: 100%;">Cities</a>
            </div>
            <div class="col-sm">
                <a href="admin-businesses.php" class="btn btn-primary" style="width: 100%; height: 100%;">Businesses</a>
            </div>
                <div class="col-sm">
            <a href="admin-articles.php" class="btn btn-primary" style="width: 100%; height: 100%;">Articles</a>
            </div>
        </div>
        <div class="row" style="padding-bottom: 25px;">
            <div class="col-sm">
                <a href="admin-listings.php" class="btn btn-primary" style="width: 100%; height: 100%;">Listings</a>
            </div>
            <div class="col-sm">
                <a href="admin-obituaries.php" class="btn btn-primary" style="width: 100%; height: 100%;">Obituaries</a>
            </div>
            <div class="col-sm">
                <a href="admin-events.php" class="btn btn-primary" style="width: 100%; height: 100%;">Events</a>
            </div>
        </div>
        <!--<section>-->
        <!--    <div class="container" style="padding: 50px 50px;">-->
        <!--    <h2 style="padding-bottom: 25px;">Add a Company</h2>-->
        <!--    <form method="post" action="scripts/add-business.php" enctype="multipart/form-data">-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="name">Company Name</label>-->
        <!--                    <input type="text" class="form-control" id="name" name="name" placeholder="" required>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="industry">Industry</label>-->
        <!--                    <input type="text" list="industry" class="form-control" name="industry" required>-->
        <!--                    <datalist id="industry">-->
        <!--                        <?php-->


        <!--                            $industriesq = mysqli_query($con, "SELECT * FROM `industry`");-->
        <!--                            while($industries = mysqli_fetch_array($industriesq)) {-->

        <!--                                echo -->
        <!--                                    '-->
        <!--                                    <option value="'.$industries['industry_name'].'">'.$industries['industry_name'].'</option>-->
        <!--                                    ';-->
        <!--                            }-->
        <!--                        ?>-->
        <!--                    </datalist>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="street">Street Address</label>-->
        <!--                    <input type="text" class="form-control" id="street" name="street" placeholder="">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-6">-->
        <!--            <div class="form-group">-->
        <!--                    <label for="city">City</label>-->
        <!--                    <input type="text" list="city" class="form-control" name="city" required>-->
        <!--                    <datalist id="city">-->
        <!--                        <?php-->

        <!--                            $citiesq = mysqli_query($con, "SELECT * FROM `city`");-->
        <!--                            while($cities = mysqli_fetch_array($citiesq)) {-->

        <!--                                echo -->
        <!--                                    '-->
        <!--                                    <option value="'.$cities['city_name'].'">'.$cities['city_name'].'</option>-->
        <!--                                    ';-->
        <!--                            }-->
        <!--                        ?>-->
        <!--                    </datalist>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="email">Email</label>-->
        <!--                    <input type="email" class="form-control" id="email" name="email" placeholder="">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="phone">Phone</label>-->
        <!--                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="row">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="website">Website</label>-->
        <!--                    <input type="text" class="form-control" id="website" name="website" placeholder="">-->
        <!--                </div>-->
        <!--        </div>-->
        <!--        <div class="row">-->
        <!--            <div class="form-group">-->
        <!--                Upload your logo:-->
        <!--                <input type="file" name="my_image" class="form-control" id="my_image">-->
        <!--                <small>Image should be 400 x 400px and of the type .jpg, .jpeg, or .png</small>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="google">Google+ Link</label>-->
        <!--                    <input type="text" class="form-control" id="google" name="google" placeholder="">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="facebook">Facebook Link</label>-->
        <!--                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="instagram">Instagram Link</label>-->
        <!--                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="twitter">Twitter Link</label>-->
        <!--                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="row">-->
        <!--            <div class="form-group">-->
        <!--                <label for="about">About</label>-->
        <!--                <textarea class="form-control" id="about" rows="5" name="about"></textarea>-->
        <!--            </div>-->
        <!--        </div>-->

        <!--        <button type="submit" class="btn btn-primary" name="submit">Create</button>-->
        <!--    </form>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- Add a company END-->

        <!--<hr>-->

        <!-- Add a article START-->
        <!--<section>-->
        <!--    <div class="container" style="padding: 50px 50px;">-->
        <!--        <h2 style="padding-bottom: 25px;">Add an Article</h2>-->
        <!--        <form method="post" action="scripts/add-article.php" enctype="multipart/form-data">-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="title">Article Title</label>-->
        <!--                    <input type="text" class="form-control" id="title" name="title" placeholder="" required>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-6">-->
        <!--            <div class="form-group">-->
        <!--                    <label for="sdesc">Short Description</label>-->
        <!--                    <input type="text" class="form-control" id="sdesc" name="sdesc" placeholder="" required>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="row" style="padding-bottom: 15px;">-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                <label for="type">Article Type</label>-->
        <!--                    <select class="form-control" id="type" name="type" onchange="displayBizSelect()" required>-->
        <!--                        <option value="0" selected="selected" disabled>Select a type...</option>-->
        <!--                        <?php-->
                                

        <!--                            $typesq = mysqli_query($con, "SELECT * FROM `article_type`");-->
        <!--                            while($types = mysqli_fetch_array($typesq)) {-->

        <!--                                echo -->
        <!--                                    '-->
        <!--                                    <option value="'.$types['type'].'">'.$types['type'].'</option>-->
        <!--                                    ';-->
        <!--                            }-->
        <!--                        ?>-->
        <!--                    </select>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-6">-->
        <!--            <div class="form-group">-->
        <!--                    <div id="biz">-->
        <!--                        <label for="biz">For Business</label>-->
        <!--                        <select class="form-control biz" id="biz" name="biz">-->
        <!--                            <?php-->

        <!--                                $bizq = mysqli_query($con, "SELECT * FROM `business`");-->
        <!--                                while($biz = mysqli_fetch_array($bizq)) {-->

        <!--                                    echo -->
        <!--                                        '-->
        <!--                                        <option value="'.$biz['business_name'].'">'.$biz['business_name'].'</option>-->
        <!--                                        ';-->
        <!--                                }-->
        <!--                            ?>-->
        <!--                        </select>-->
        <!--                    </div>-->
        <!--                    <div id="article-city">-->
        <!--                        <label for="article-city">For City</label>-->
        <!--                        <select class="form-control" id="article-city" name="article-city">-->
        <!--                            <?php-->

        <!--                                $articleCitiesq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_approved` = 1");-->
        <!--                                while($articleCities = mysqli_fetch_array($articleCitiesq)) {-->

        <!--                                    echo -->
        <!--                                        '-->
        <!--                                        <option value="'.$articleCities['city_name'].'">'.$articleCities['city_name'].'</option>-->
        <!--                                        ';-->
        <!--                                }-->
        <!--                            ?>-->
        <!--                        </select>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="row">-->
        <!--        <div class="form-group">-->
        <!--                    Upload an image:-->
        <!--                    <input type="file" name="my_image" class="form-control" id="my_image">-->
                            <!-- <small>Image should be 400 x 400px and of the type .jpg, .jpeg, or .png</small> -->
        <!--                </div>-->
        <!--        </div>-->


        <!--        <div class="row">-->
        <!--            <div class="form-group">-->
        <!--                <label for="body">Body</label>-->
        <!--                <textarea class="form-control" id="article-body" rows="10" name="article-body" required></textarea>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <button type="submit" class="btn btn-primary" name="article-submit">Create</button>-->
        <!--        </form>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- Add a article END-->
        
        <!-- Upload Badge START-->
        <!--<section>-->
        <!--    <div class="container" style="padding: 50px 50px;">-->
        <!--        <h2 style="padding-bottom: 25px;">Upload a Badge</h2>-->
        <!--        <form method="post" action="scripts/upload-badge.php" enctype="multipart/form-data">-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="badge-name">Badge Name</label>-->
        <!--                    <input type="text" class="form-control" id="badge-name" name="badge-name" placeholder="" required>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    Upload an image:-->
        <!--                    <input type="file" name="my_image" class="form-control" id="my_image" required>-->
                            <!-- <small>Image should be 400 x 400px and of the type .jpg, .jpeg, or .png</small> -->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <button type="submit" class="btn btn-primary" name="badge-submit">Upload</button>-->
        <!--        </form>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- Upload Badge END-->
        
        <!-- Upload City Featured Newsletter START-->
        <!--<section>-->
        <!--    <div class="container" style="padding: 50px 50px;">-->
        <!--        <h2 style="padding-bottom: 25px;">Upload a City Featured Newsletter</h2>-->
        <!--        <form method="post" action="scripts/upload-city-featured-newsletter.php" enctype="multipart/form-data">-->
        <!--        <div class="row">-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    <div id="city">-->
        <!--                        <label for="city">City</label>-->
        <!--                        <select class="form-control" id="city" name="city" required>-->
        <!--                            <?php-->

        <!--                                $articleCitiesq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_approved` = 1");-->
        <!--                                while($articleCities = mysqli_fetch_array($articleCitiesq)) {-->

        <!--                                    echo -->
        <!--                                        '-->
        <!--                                        <option value="'.$articleCities['id'].'">'.$articleCities['city_name'].'</option>-->
        <!--                                        ';-->
        <!--                                }-->
        <!--                            ?>-->
        <!--                        </select>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-md-6">-->
        <!--                <div class="form-group">-->
        <!--                    Upload a File:-->
        <!--                    <input type="file" name="my_image" class="form-control" id="my_image" required>-->
                            <!-- <small>Image should be 400 x 400px and of the type .jpg, .jpeg, or .png</small> -->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <button type="submit" class="btn btn-primary" name="city-newsletter-submit">Upload</button>-->
        <!--        </form>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- Upload City Featured Newsletter END-->

        <!--<hr>-->

        <!-- Approve Business START -->
        <!--<section id="approve-business">-->
        <!--    <div class="accordion accordion-flush" id="accordionFlushExample">-->
        <!--        <div class="accordion-item" >-->
        <!--            <h2 class="accordion-header" id="flush-headingThree">-->
        <!--              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">-->
        <!--                Approve a Business-->
        <!--              </button>-->
        <!--            </h2>-->
        <!--            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">-->
        <!--    <div class="accordion-body">-->
        <!--    <div class="table-responsive">-->
        <!--        <table class="table">-->
        <!--            <thead>-->
        <!--                <tr>-->
        <!--                    <th>Business Name</th>-->
        <!--                    <th>Phone</th>-->
        <!--                    <th>Email</th>-->
        <!--                    <th>Address</th>-->
        <!--                    <th>City</th>-->
        <!--                    <th>Industry</th>-->
        <!--                    <th>Website</th>-->
        <!--                    <th>Approve</th>-->
        <!--                </tr>-->
        <!--            </thead>-->
        <!--            </tbody>-->

        <!--    <?php-->
        <!--        $businessq = mysqli_query($con, "SELECT * FROM `business` WHERE `business_approved` = 0");-->
        <!--        while($business = mysqli_fetch_array($businessq)) {-->
                    // GET BIZ INDUSTRY
        <!--            $bizIndustryq = mysqli_query($con, "SELECT * FROM `industry` WHERE `id` = '".$business['business_industry_id']."'");-->
        <!--            $bizIndustry = mysqli_fetch_array($bizIndustryq);-->

                    // GET BIZ CITY
        <!--            $bizCityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$business['business_city_id']."'");-->
        <!--            $bizCity = mysqli_fetch_array($bizCityq);-->

        <!--            echo -->
        <!--            '-->
        <!--                <tr>-->
        <!--                    <form method="post" action="scripts/approve-business.php">-->
        <!--                    <td>'.$business['business_name'].'</td>-->
        <!--                    <td>'.$business['business_phone'].'</td>-->
        <!--                    <td>'.$business['business_email'].'</td>-->
        <!--                    <td>'.$business['business_street'].'</td>-->
        <!--                    <td><input type="text" name="city" value="'.$bizCity['city_name'].'"></td>-->
        <!--                    <td><input type="text" name="industry" value="'.$bizIndustry['industry_name'].'"></td>-->
        <!--                    <td>'.$business['business_website'].'</td>-->
        <!--                    <td>-->
        <!--                        <input type="hidden" name="biz-id" value="'.$business['id'].'">-->
        <!--                        <button type="submit" class="btn btn-primary" style="padding: 20px 35px;" name="approve">Approve</button>-->
        <!--                    </td>-->
        <!--                    </form>-->
        <!--                </tr>-->
        <!--            ';-->
        <!--        }-->
        <!--    ?>-->
        <!--    </table>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--</section>-->

        <!-- Approve Business END -->
        
        <!-- Approve Listing START -->
        <!--<section id="approve-listing">-->
        <!--    <div class="accordion accordion-flush" id="accordionFlushExample">-->
        <!--        <div class="accordion-item" >-->
        <!--            <h2 class="accordion-header" id="flush-headingFour">-->
        <!--              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">-->
        <!--                Approve a Listing-->
        <!--              </button>-->
        <!--            </h2>-->
        <!--            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">-->
        <!--        <div class="accordion-body">-->
        <!--        <div class="table-responsive">-->
        <!--            <table class="table">-->
        <!--                <thead>-->
        <!--                    <tr>-->
        <!--                        <th>Title</th>-->
        <!--                        <th>Name</th>-->
        <!--                        <th>Price</th>-->
        <!--                        <th>Link</th>-->
        <!--                        <th>City</th>-->
        <!--                        <th>Decline</th>-->
        <!--                        <th>Approve</th>-->
        <!--                    </tr>-->
        <!--                </thead>-->
        <!--                </tbody>-->

        <!--                <?php-->
        <!--                    $listingq = mysqli_query($con, "SELECT * FROM `listing` WHERE `listing_approved` = 0");-->
        <!--                    while($listing = mysqli_fetch_array($listingq)) {-->
        <!--                        $cityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$listing['city_id']."'");-->
        <!--                        $city = mysqli_fetch_array($cityq);-->
            
        <!--                        echo -->
        <!--                        '-->
        <!--                            <tr>-->
        <!--                                <td><a href="listing.php?id='.$listing['id'].'" style="color: #1a213d;">'.$listing['title'].'</a></td>-->
        <!--                                <td>'.$listing['name'].'</td>-->
        <!--                                <td>'.$listing['price'].'</td>-->
        <!--                                <td>'.$listing['link'].'</td>-->
        <!--                                <td>'.$city['city_name'].'</td>-->
        <!--                                <td>-->
        <!--                                    <form method="post" action="scripts/decline-listing.php">-->
        <!--                                        <input type="hidden" name="listing-id-decline" value='.$listing['id'].'>-->
        <!--                                        <button type="submit" class="btn btn-primary" style="padding: 20px 35px; background-color: grey;" name="decline">Decline</button>-->
        <!--                                    </form>-->
        <!--                                </td>-->
        <!--                                <td>-->
        <!--                                    <form method="post" action="scripts/approve-listing.php">-->
        <!--                                        <input type="hidden" name="listing-id" value='.$listing['id'].'>-->
        <!--                                        <button type="submit" class="btn btn-primary" style="padding: 20px 35px;" name="approve">Approve</button>-->
        <!--                                    </form>-->
        <!--                                </td>-->
        <!--                            </tr>-->
        <!--                        ';-->
        <!--                    }-->
        <!--                ?>-->
        <!--                </table>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--</section>-->

        <!-- Approve Listing END -->
        
        <!-- Approve Obituary START -->
        <!--<section id="approve-obituary">-->
        <!--    <div class="accordion accordion-flush" id="accordionFlushExample">-->
        <!--        <div class="accordion-item" >-->
        <!--            <h2 class="accordion-header" id="flush-headingEight">-->
        <!--              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">-->
        <!--                Approve an Obituary-->
        <!--              </button>-->
        <!--            </h2>-->
        <!--            <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">-->
        <!--        <div class="accordion-body">-->
        <!--        <div class="table-responsive">-->
        <!--            <table class="table">-->
        <!--                <thead>-->
        <!--                    <tr>-->
        <!--                        <th>Deceased's Name</th>-->
        <!--                        <th>Submitter's Name</th>-->
        <!--                        <th>Decline</th>-->
        <!--                        <th>Approve</th>-->
        <!--                    </tr>-->
        <!--                </thead>-->
        <!--                </tbody>-->

        <!--                <?php-->
        <!--                    $listingq = mysqli_query($con, "SELECT * FROM `obituary` WHERE `obituary_approved` = 0");-->
        <!--                    while($listing = mysqli_fetch_array($listingq)) {-->
        <!--                        $cityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$listing['city_id']."'");-->
        <!--                        $city = mysqli_fetch_array($cityq);-->
            
        <!--                        echo -->
        <!--                        '-->
        <!--                            <tr>-->
        <!--                                <td><a href="listing.php?id='.$listing['id'].'" style="color: #1a213d;">'.$listing['deceased_name'].'</a></td>-->
        <!--                                <td>'.$listing['name'].'</td>-->
        <!--                                <td>-->
        <!--                                    <form method="post" action="scripts/decline-obituary.php">-->
        <!--                                        <input type="hidden" name="obituary-id-decline" value='.$listing['id'].'>-->
        <!--                                        <button type="submit" class="btn btn-primary" style="padding: 20px 35px; background-color: grey;" name="decline">Decline</button>-->
        <!--                                    </form>-->
        <!--                                </td>-->
        <!--                                <td>-->
        <!--                                    <form method="post" action="scripts/approve-obituary.php">-->
        <!--                                        <input type="hidden" name="obituary-id" value='.$listing['id'].'>-->
        <!--                                        <button type="submit" class="btn btn-primary" style="padding: 20px 35px;" name="approve">Approve</button>-->
        <!--                                    </form>-->
        <!--                                </td>-->
        <!--                            </tr>-->
        <!--                        ';-->
        <!--                    }-->
        <!--                ?>-->
        <!--                </table>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--</section>-->

        <!-- Approve Obituary END -->
        
        <!-- Approve Article START -->
        <!--<section id="approve-article">-->
        <!--    <div class="accordion accordion-flush" id="accordionFlushExample">-->
        <!--    <div class="accordion-item" >-->
        <!--        <h2 class="accordion-header" id="flush-headingFive">-->
        <!--          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">-->
        <!--            Approve an Article-->
        <!--          </button>-->
        <!--        </h2>-->
        <!--        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">-->
        <!--          <div class="accordion-body">-->
        <!--            <div class="table-responsive">-->
        <!--                <table class="table">-->
        <!--                    <thead>-->
        <!--                        <tr>-->
        <!--                            <th>Title</th>-->
        <!--                            <th>Type</th>-->
        <!--                            <th>For</th>-->
        <!--                            <th>Description</th>-->
        <!--                            <th>Timestamp</th>-->
        <!--                            <th>Approve</th>-->
        <!--                        </tr>-->
        <!--                    </thead>-->
        <!--                    </tbody>-->

        <!--                    <?php-->
        <!--                        $articleq = mysqli_query($con, "SELECT * FROM `article` WHERE `article_approved` = 0");-->
        <!--                        while($article = mysqli_fetch_array($articleq)) {-->
        <!--                            $typeq = mysqli_query($con, "SELECT * FROM `article_type` WHERE `id` = '".$article['type_id']."'");-->
        <!--                            $type = mysqli_fetch_array($typeq);-->
                                    
        <!--                            if($type['id'] == 2){-->
        <!--                                $businessq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '".$article['business_id']."'");-->
        <!--                                $business = mysqli_fetch_array($businessq);-->
        <!--                                $for = $business['business_name'];-->
        <!--                            } else if ($type['id'] == 3){-->
        <!--                                $cityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$article['city_id']."'");-->
        <!--                                $city = mysqli_fetch_array($cityq);-->
        <!--                                $for = $city['city_name'];-->
        <!--                            } else {-->
        <!--                                $for = "";-->
        <!--                            }-->
                
        <!--                            echo -->
        <!--                            '-->
        <!--                                <tr>-->
        <!--                                    <form method="post" action="scripts/approve-article.php">-->
        <!--                                    <td><a href="article.php?article='.$article['id'].'" style="color: #1a213d;">'.$article['article_title'].'</a></td>-->
        <!--                                    <td>'.$type['type'].'</td>-->
        <!--                                    <td>'.$for.'</td>-->
        <!--                                    <td>'.$article['article_description'].'</td>-->
        <!--                                    <td>'.$article['article_timestamp'].'</td>-->
        <!--                                    <td>-->
        <!--                                        <input type="hidden" name="article-id" value='.$article['id'].'>-->
        <!--                                        <button type="submit" class="btn btn-primary" style="padding: 20px 35px;" name="approve">Approve</button>-->
        <!--                                    </td>-->
        <!--                                    </form>-->
        <!--                                </tr>-->
        <!--                            ';-->
        <!--                        }-->
        <!--                    ?>-->
        <!--                </table>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--</section>-->

        <!-- Approve Article END -->
        
        <!-- Approve Event START -->
        <!--<section id="approve-event">-->
        <!--    <div class="accordion accordion-flush" id="accordionFlushExample">-->
        <!--        <div class="accordion-item" >-->
        <!--            <h2 class="accordion-header" id="flush-headingSix">-->
        <!--              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">-->
        <!--                Approve an Event-->
        <!--              </button>-->
        <!--            </h2>-->
        <!--            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">-->
        <!--              <div class="accordion-body">-->
        <!--                <div class="table-responsive">-->
        <!--                    <table class="table">-->
        <!--                        <thead>-->
        <!--                            <tr>-->
        <!--                                <th>Title</th>-->
        <!--                                <th>Name</th>-->
        <!--                                <th>Start Date</th>-->
        <!--                                <th>Link</th>-->
        <!--                                <th>City</th>-->
        <!--                                <th>Decline</th>-->
        <!--                                <th>Approve</th>-->
        <!--                            </tr>-->
        <!--                        </thead>-->
        <!--                        </tbody>-->
        
        <!--                <?php-->
        <!--                    $eventq = mysqli_query($con, "SELECT * FROM `event` WHERE `event_approved` = 0");-->
        <!--                    while($event = mysqli_fetch_array($eventq)) {-->
        <!--                        $cityq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '".$event['city_id']."'");-->
        <!--                        $city = mysqli_fetch_array($cityq);-->
            
        <!--                        echo -->
        <!--                        '-->
        <!--                            <tr>-->
        <!--                                <td><a href="event.php?id='.$event['id'].'" style="color: #1a213d;">'.$event['title'].'</a></td>-->
        <!--                                <td>'.$event['name'].'</td>-->
        <!--                                <td>'.$event['start_date'].'</td>-->
        <!--                                <td>'.$event['link'].'</td>-->
        <!--                                <td>'.$city['city_name'].'</td>-->
        <!--                                <td>-->
        <!--                                    <form method="post" action="scripts/decline-event.php">-->
        <!--                                        <input type="hidden" name="event-id-decline" value='.$event['id'].'>-->
        <!--                                        <button type="submit" class="btn btn-primary" style="padding: 20px 35px; background-color: grey;" name="decline">Decline</button>-->
        <!--                                    </form>-->
        <!--                                </td>-->
        <!--                                <td>-->
        <!--                                    <form method="post" action="scripts/approve-event.php">-->
        <!--                                        <input type="hidden" name="event-id" value='.$event['id'].'>-->
        <!--                                        <button type="submit" class="btn btn-primary" style="padding: 20px 35px;" name="approve">Approve</button>-->
        <!--                                    </form>-->
        <!--                                </td>-->
        <!--                            </tr>-->
        <!--                        ';-->
        <!--                    }-->
        <!--                ?>-->
        <!--                </table>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- Approve Event END -->
        
        <!-- Requested Cities -->
        <!--<section id="approve-event">-->
        <!--<div class="accordion accordion-flush" id="accordionFlushExample">-->
        <!--  <div class="accordion-item" >-->
        <!--    <h2 class="accordion-header" id="flush-headingSeven">-->
        <!--      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">-->
        <!--        Requested Cities-->
        <!--      </button>-->
        <!--    </h2>-->
        <!--    <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">-->
        <!--      <div class="accordion-body">-->
        <!--          <table class="table">-->
        <!--            <thead>-->
        <!--                <tr>-->
        <!--                    <th>ID</th>-->
        <!--                    <th>City Name</th>-->
        <!--                    <th>Name</th>-->
        <!--                    <th>Email</th>-->
        <!--                    <th>Phone</th>-->
        <!--                </tr>-->
        <!--            </thead>-->
        <!--            </tbody>-->

        <!--    <?php-->
        <!--        $cityRequestq = mysqli_query($con, "SELECT * FROM `city_request`");-->
        <!--        while($cityRequest = mysqli_fetch_array($cityRequestq)) {-->
        <!--            echo -->
        <!--            '-->
        <!--                <tr>-->
        <!--                    <td>'.$cityRequest['id'].'</td>-->
        <!--                    <td>'.$cityRequest['city_name'].'</td>-->
        <!--                    <td>'.$cityRequest['name'].'</td>-->
        <!--                    <td>'.$cityRequest['email'].'</td>-->
        <!--                    <td>'.$cityRequest['phone'].'</td>-->
        <!--                </tr>-->
        <!--            ';-->
        <!--        }-->
        <!--    ?>-->
        <!--    </table>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
        <!--</section>-->
        
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