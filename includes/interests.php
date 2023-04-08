<!-- You Interested  Start-->
<section class="popular-location section-padding section-bg" id="places-of-interest">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-40">
                            <h2>Places of Interest</h2>
                            <p>Things you are looking for today</p>
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

            $articlesq = mysqli_query($con, "SELECT * FROM `article` WHERE `type_id` = 1");
            while($articles = mysqli_fetch_array($articlesq)) {
                $rowCount++;
                echo 
                    '
                    <div class="col-md-'.$colWidth.'">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 col-sm-6">
                                <a href="../article.php?article='.$articles['id'].'">
                                <button type="submit" name="submit" style="all: unset; cursor: pointer;">
                                <input type="hidden" value="'.$articles['article_title'].'" name="article-title" >
                                <div class="single-location mb-20">
                                    <div class="location-img">
                                    <img src="assets/img/article-images/'.$articles['article_image'].'" alt="">
                                    </div>
                                    <div class="location-details">
                                        <h4><a href="../article.php?article='.$articles['id'].'">'.$articles['article_title'].'</a></h4>
                                    </div>
                                </div>
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    ';
                
                if($rowCount % $numCols == 0) echo '</div><div class="row">';
            }

            ?>

                </div>
            </div>
        </section>
        <!--You Interested  End -->