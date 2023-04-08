<?php

require '../includes/mysql.php';

if(isset($_POST['submit'])){

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

//     echo "<pre>";
// 	print_r($_FILES['my_image']);
// 	echo "</pre>";

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
        $img_upload_path = '../assets/img/business-logos/'.$new_img_name;
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
    header("Location: ../company.php?id=".$bizId);

}

?>