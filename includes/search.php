<?php

$searchTerm = $_POST['searchTerm'];
header('Location: ../search-results.php?search='.$searchTerm);

?>