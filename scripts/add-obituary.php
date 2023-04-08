<?php

require '../includes/mysql.php';

$getAllObituaries = mysqli_query($con, "SELECT * FROM `obituary`");

$getLastListingIDq = mysqli_query($con, "SELECT * FROM `obituary` ORDER BY `id` DESC LIMIT 1");
$countOfObituaries = mysqli_num_rows($getAllObituaries);
if($countOfObituaries == 0){
    $lastListingID = 1;
} else {
$getLastListingID = mysqli_fetch_array($getLastListingIDq);
$lastListingID = $getLastListingID['id'] + 1;
}

if(isset($_POST['submit'])){
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
    
    
    // ARTICLE IMAGE
//     echo "<pre>";
// 	print_r($_FILES['my_image']);
// 	echo "</pre>";
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
        $img_upload_path = '../assets/img/obituary-images/'.$new_img_name;
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
    header("Location: ../obituary.php?id=$lastListingID");


}


?>