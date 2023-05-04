<?php

require '../includes/mysql.php';

if(isset($_POST['article-submit'])){
    // ARTICLE FORM INPUTS
    $title = $_POST['title'];
    $description = $_POST['sdesc'];
    $type = $_POST['type'];
    $bizId = $_POST['biz'];
    $body = mysqli_real_escape_string($con, $_POST['article-body']);
    $timestamp = date('Y-m-d H:i:s');

    // ARTICLE TYPE for BUSINESS
    $typeId = 2;

    // BUSINESS INFO
    $bizidq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = '$bizId'");
    $bizidf = mysqli_fetch_array($bizidq);
    
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
        '0',
        '$new_img_name',
        '$body',
        '$timestamp'
        )") or die(mysqli_error($con));
    header("Location: ../article.php?article=".$title);


}


?>