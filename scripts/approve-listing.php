<?php

require '../includes/mysql.php';

$listingId = $_POST['listing-id'];

mysqli_query($con, "UPDATE `listing` SET `listing_approved` = 1 WHERE `id` = ".$listingId."");

header("Location: ../listing.php?id=$listingId");
?>