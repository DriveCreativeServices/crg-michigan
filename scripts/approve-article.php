<?php

require '../includes/mysql.php';

$articleId = $_POST['article-id'];

mysqli_query($con, "UPDATE `article` SET `article_approved` = 1 WHERE `id` = ".$articleId."");

header("Location: ../article.php?article=$articleId");
?>