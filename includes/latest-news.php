<?php

require 'includes/mysql.php';

$cityId = $_GET['id'];

?>

<!-- You Interested  Start-->
<section class="popular-location section-padding section-bg" id="latest-news">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-80">
                            <h2>Latest News</h2>
                            <p>Learn about what is happening</p>
                        </div>
                    </div>
                </div>

            <?php
            $numCols = 3;
            $rowCount = 0;
            $colWidth = 12 / $numCols;
            ?>

            <div class="row">

            <?php

            $articlesq = mysqli_query($con, "SELECT * FROM `article` WHERE `city_id` = '$cityId' && `type_id` = 3");
            $articleCount = mysqli_num_rows($articlesq);
            $count = 0;
            while($count < 6 && $articles = mysqli_fetch_array($articlesq)) {
                $rowCount++;

                if($articles['article_image'] == ''){
                    $displayArticleImage = "<img src='assets/img/gallery/directory1.jpg' alt='' style='height: 200px; width: 100%; object-fit: cover;'>";
                 } else {
                     $displayArticleImage = "<img src='assets/img/article-images/".$articles['article_image']."' alt='' style='height: 200px; width: 100%; object-fit: cover;'>";
                 }

                echo 
                    '
                    <div class="col-md-'.$colWidth.'">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6">
                                <a href="../article.php?id='.$articles['id'].'">
                                <button type="submit" name="submit" style="all: unset; cursor: pointer; width: 100%;">
                                <div class="single-location mb-20">
                                    <div class="location-img">
                                    '.$displayArticleImage.'
                                    </div>
                                    <div class="location-details">
                                        <h4><a href="../article.php?id='.$articles['id'].'">'.$articles['article_title'].'</a></h4>
                                    </div>
                                </div>
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    ';

                $count++;
                
                if($rowCount % $numCols == 0) echo '</div><div class="row">';
            }

            if($articleCount > 6){
                echo '<a href="more-articles.php?id='.$articles['id'].'" style="color: blue; text-decoration: underline; text-align: center;">Show More</a>';
              }

            ?>

                </div>
            </div>
        </section>
        <!--You Interested  End -->