<?php

if(isset($_POST['submit'])){
    $businessName = $_POST['business-name'];
    header('Location: ../add-article.php?businessName='.$businessName);
}

?>