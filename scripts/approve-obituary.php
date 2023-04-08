<?php

require '../includes/mysql.php';

$obituaryId = $_POST['obituary-id'];

mysqli_query($con, "UPDATE `obituary` SET `obituary_approved` = 1 WHERE `id` = ".$obituaryId."");

header("Location: ../obituary.php?id=$obituaryId");
?>