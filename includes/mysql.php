<?php

$user = 'root';
$pwd = $MARIADB_PASSWORD;
$db = 'crgmich';

$con = new mysqli('node12664-crg-prod.us.reclaim.cloud', $user, $pwd, $db) or die("Unable to connect to database");

?>
