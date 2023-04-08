<?php

if(isset($_COOKIE['login'])){
    $username = $_COOKIE['login'];
} else {
    $username = '';
}

if(isset($_POST['logout'])) {
    setcookie('login', $username, time()-3600);
    header('location: index.php');
}

?>