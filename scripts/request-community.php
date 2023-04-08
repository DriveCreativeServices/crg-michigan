<?php

require '../includes/mysql.php';

if(isset($_POST['submit'])){
    // ARTICLE FORM INPUTS
    $city = $_POST['city'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    

    // INSERT INTO DB
    mysqli_query($con, "INSERT INTO `city_request` (
        `city_name`, 
        `name`,
        `email`,
        `phone`
        ) VALUES (
        '$city',
        '$name',
        '$email',
        '$phone'
        )") or die(mysqli_error($con));
    header("Location: ../city-request-confirmation.php");


}

?>