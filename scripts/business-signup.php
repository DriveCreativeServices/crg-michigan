<?php

require '../includes/mysql.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $industry = $_POST['industry'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    $website = $_POST['website'];
    $about = $_POST['about'];

    $img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];
	
	$getAllBiz = mysqli_query($con, "SELECT * FROM `business`");
	
	$getLastBizIDq = mysqli_query($con, "SELECT * FROM `business` ORDER BY `id` DESC LIMIT 1");
    $countOfBiz = mysqli_num_rows($getAllBiz);
    if($countOfBiz == 0){
        $lastBizID = 1;
    } else {
    $getLastBizID = mysqli_fetch_array($getLastBizIDq);
    $lastBizID = $getLastBizID['id'] + 1;
    }


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
        $img_upload_path = '../assets/img/business-logos/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    } else {
        $new_img_name = '';
    }
    

    mysqli_query($con, "INSERT INTO `business` (
        `business_name`, 
        `business_industry_id`, 
        `business_city_id`, 
        `business_street`,
        `business_phone`,
        `business_email`,
        `business_website`,
        `business_facebook`,
        `business_instagram`,
        `business_linkedin`,
        `business_about`,
        `business_logo`,
        `business_approved`
        ) VALUES (
        '$name',
        '$industryid',
        '$cityid',
        '$street',
        '$phone',
        '$email',
        '$website',
        '$facebook',
        '$instagram',
        '$linkedin',
        '$about',
        '$new_img_name',
        0
        )") or die(mysqli_error($con));
        
    header("Location: ../company.php?id=".$lastBizID);

}

?>