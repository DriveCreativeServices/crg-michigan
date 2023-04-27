# Introduction

The Community Resource Guide is a new digital platform designed to make engaging with your community fun and easy. Designed to make keeping up and connecting easy, fun, and informative.

[https://crgmichigan.com/](https://crgmichigan.com/)

# Run Locally

1. Export current database from prod environment.

2. Add `includes/mysql.php` file with contents:

    ```
    <?php

    $user = 'root';
    $pwd = '';
    $db = 'crgmich';

    $con = new mysqli('localhost', $user, $pwd, $db) or die("Unable to connect to database");

    ?>
    ```

3. Run site on a local server