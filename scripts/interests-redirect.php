<?php

if(isset($_POST['submit'])){
    $articleTitle = $_POST['article-title'];
    header('Location: ../article.php?article='.$articleTitle);
}

?>