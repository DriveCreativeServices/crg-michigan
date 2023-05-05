<?php

require 'includes/mysql.php';

$cityId = $_GET['id'];

$cityidq = mysqli_query($con, "SELECT * FROM `city` WHERE `id` = '$cityId'");
$cityidf = mysqli_fetch_array($cityidq);


?>

<!-- You Interested  Start-->
<section id="upcoming-events" style="padding-bottom: 50px;">
            <div class="container" style="padding: 0px; width: 100%;">
                <h1 style="font-family: 'Work Sans', sans-serif; color: #1a213d; font-size: 36px; display: block; font-weight: 600; line-height: 1.4; margin-bottom: 14px;">Upcoming Events</h1>
                <?php
                    $eventsq = mysqli_query($con, "SELECT * FROM `event` WHERE `city_id` = '$cityId' AND `event_approved` = 1");
                    while($events = mysqli_fetch_array($eventsq)){
                    echo '
                        <div class="upcoming-event">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h2 style="color: white;">'.$events['title'].'</h2>
                                    <p>'.$events['description'].'</p>
                                </div>
                                <div class="col-sm-2" style="display: flex; align-items: center; justify-content: center;">
                                    <a href="event.php?id='.$events['id'].'" style="border-radius: 30px; background-color: white; color: #1a213d; width: 200px; height: 50px; text-align: center; padding-top: 13px; font-weight: 700;">Learn More</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
                
                ?>
            </div>
        </section>
        <!--You Interested  End -->