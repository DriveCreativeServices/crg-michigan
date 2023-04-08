<?php

require '../includes/mysql.php';

$bizId = $_POST['biz-id'];

mysqli_query($con, "UPDATE `business` SET `business_approved` = 1 WHERE `id` = ".$bizId."");

$bizq = mysqli_query($con, "SELECT * FROM `business` WHERE `id` = ".$bizId."");
$biz = mysqli_fetch_array($bizq);
$name = $biz['business_name'];
$email = $biz['business_email'];

// Generate random password
$length = 10;
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}
$genPassword = md5($randomString);
    
mysqli_query($con, "INSERT INTO `user` (`user_name`, `user_password`, `user_is_business`, `business_id`) VALUES ('$email', '$genPassword', 1, $bizId)");
mail($email, "CRG Michigan Login Information", "Username: ".$email." \n Password: ".$randomString."");
mail("info@drivecreativeservices.com", "CRG Business User Account Created", "Username: ".$email." \n Password: ".$randomString."");
header('Location: ../company.php?id='.$bizId);
?>