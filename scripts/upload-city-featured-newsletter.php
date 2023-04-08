<?php

require '../includes/mysql.php';

if(isset($_POST['city-newsletter-submit'])){

    $city = $_POST['city'];
    
    // ARTICLE IMAGE
    $img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $allowed_exs = array("pdf"); 

    if (in_array($img_ex_lc, $allowed_exs)) {
        // Image 1
        $new_img_name = "$city.pdf";
        $img_upload_path = '../assets/img/city-featured-newsletter/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
        
            $hasNewsletterq = mysqli_query($con, "SELECT * FROM `city_featured_newsletter`");
            while ($hasNewsletter = mysqli_fetch_array($hasNewsletterq)){
                if($hasNewsletter['city_id'] = $city){
                    // UPDATE DB
                    mysqli_query($con, "UPDATE `city_featured_newsletter` SET `newsletter` = '$new_img_name' WHERE `city_id` = '$city'");
                    header("Location: ../city.php?id=$city");
                } else {
                    // INSERT INTO DB
                    mysqli_query($con, "INSERT INTO `city_featured_newsletter` (
                        `city_id`, 
                        `newsletter`
                        ) VALUES (
                        '$city',
                        '$new_img_name'
                        )") or die(mysqli_error($con));
                    header("Location: ../city.php?id=$city");
                }
            }
    } else {
        echo '<script>alert("File is not a PDF or you did not upload a file.");</script>"';
    }


}


?>