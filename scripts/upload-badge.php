<?php

require '../includes/mysql.php';

if(isset($_POST['badge-submit'])){

    $badgeName = $_POST['badge-name'];
    
    // ARTICLE IMAGE
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
        $img_upload_path = '../assets/img/badge-images/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    } else {
        echo '<script>alert("Badge image must have an image.");</script>"';
    }

    // INSERT INTO DB
    mysqli_query($con, "INSERT INTO `badge` (
        `name`, 
        `img`
        ) VALUES (
        '$badgeName',
        '$new_img_name'
        )") or die(mysqli_error($con));
    header("Location: ../admin.php#upload-badge");


}


?>