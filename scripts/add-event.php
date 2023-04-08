<?php

require '../includes/mysql.php';

$getLastListingIDq = mysqli_query($con, "SELECT * FROM `event` ORDER BY `id` DESC LIMIT 1");
$numListings = mysqli_num_rows($getLastListingIDq);
$getLastListingID = mysqli_fetch_array($getLastListingIDq);
if($numListings > 0){
    $lastListingID = $getLastListingID['id'] + 1;
} else {
    $lastListingID = 1;
}

if(isset($_POST['submit'])){
    // ARTICLE FORM INPUTS
    $title = $_POST['title'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $startDate = $_POST['start-date'];
    $endDate = $_POST['end-date'];
    $link = $_POST['link'];
    $city = $_POST['city'];
    $description = $_POST['description'];
    $timestamp = date('Y-m-d H:i:s');

    $cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `city_name` = '$city'");
    $cityidf = mysqli_fetch_array($cityidq);
    $cityId = $cityidf['id'];
    

    // INSERT INTO DB
    mysqli_query($con, "INSERT INTO `event` (
        `title`, 
        `name`,
        `email`,
        `phone`,
        `address1`,
        `address2`,
        `city`,
        `state`,
        `zip`,
        `start_date`,
        `end_date`,
        `link`,
        `city_id`,
        `description`,
        `timestamp`
        ) VALUES (
        '$title',
        '$name',
        '$email',
        '$phone',
        '$address1',
        '$address2',
        '$city',
        '$state',
        '$zip',
        '$startDate',
        '$endDate',
        '$link',
        '$cityId',
        '$description',
        '$timestamp'
        )") or die(mysqli_error($con));
    header("Location: ../event.php?id=$lastListingID");


}


?>