<?php

require '../includes/mysql.php';

if(isset($_POST['article-submit'])){
    // ARTICLE FORM INPUTS
    $title = $_POST['title'];
    $description = $_POST['sdesc'];
    $type = $_POST['type'];
    $business = $_POST['biz'];
    $city = $_POST['article-city'];
    $body = $_POST['article-body'];
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
        $img_upload_path = '../assets/img/article-images/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    } else {
        echo '<script>alert("Article image must by of file type .jpg, .jpeg, or .png");</script>"';
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
    header("Location: ../article.php?article=".$nextArticleID);


}


?>