<?php

if(isset($_POST['submit'])){
    $businessName = $_POST['business-name'];
    header('Location: ../edit-profile.php?businessName='.$businessName);
}

?>