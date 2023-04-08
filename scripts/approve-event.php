<?php

require '../includes/mysql.php';

$eventId = $_POST['event-id'];

mysqli_query($con, "UPDATE `event` SET `event_approved` = 1 WHERE `id` = ".$eventId."");

header("Location: ../event.php?id=$eventId");
?>