<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>

	h2.title {
        font-family: "Work Sans", sans-serif;
        color: #1a213d;
        font-size: 36px;
        display: block;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 14px;
	}
	.row {
	    margin: 0px;
	}
	.popover.calendar-event-popover {
		font-family: 'Roboto', sans-serif;
		font-size: 12px;
		color: rgb(120, 120, 120);
		border-radius: 2px;
		max-width: 300px;
	}
	.popover.calendar-event-popover h4 {
		font-size: 14px;
		font-weight: 900;
	}
	.popover.calendar-event-popover .location,
	.popover.calendar-event-popover .datetime {
		font-size: 14px;
		font-weight: 700;
		margin-bottom: 5px;
	}
	.popover.calendar-event-popover .location > span,
	.popover.calendar-event-popover .datetime > span {
		margin-right: 10px;
	}
	.popover.calendar-event-popover .space,
	.popover.calendar-event-popover .attending {
		margin-top: 10px;
		padding-bottom: 5px;
		border-bottom: 1px solid rgb(160, 160, 160);
		font-weight: 700;
	}
	.popover.calendar-event-popover .space > .pull-right,
	.popover.calendar-event-popover .attending > .pull-right {
		font-weight: 400;
	}
	.popover.calendar-event-popover .attending {
		margin-top: 5px;
		font-size: 18px;
		padding: 0px 10px 5px;
	}
	.popover.calendar-event-popover .attending img {
		border-radius: 50%;
		width: 40px;
	}
	.popover.calendar-event-popover .attending span.attending-overflow {
		display: inline-block;
		width: 40px;
		background-color: rgb(200, 200, 200);
		border-radius: 50%;
		padding: 8px 0px 7px;
		text-align: center;
	}
	.popover.calendar-event-popover .attending > .pull-right {
		font-size: 28px;
	}
	.popover.calendar-event-popover a.btn {
		margin-top: 10px;
		width: 100%;
		border-radius: 3px;
	}
	[data-toggle="calendar"] > .row > .calendar-day {
		font-family: 'Roboto', sans-serif;
		width: 14.28571428571429%;
		border: 1px solid rgb(235, 235, 235);
		border-right-width: 0px;
		border-bottom-width: 0px;
		min-height: 120px;
	}
	[data-toggle="calendar"] > .row > .calendar-day.calendar-no-current-month {
		color: rgb(200, 200, 200);
	}
	[data-toggle="calendar"] > .row > .calendar-day:last-child {
		border-right-width: 1px;
	}

	[data-toggle="calendar"] > .row:last-child > .calendar-day {
		border-bottom-width: 1px;
	}

	.calendar-day > time {
		position: absolute;
		display: block;
		bottom: 0px;
		left: 0px;
		font-size: 12px;
		font-weight: 300;
		width: 100%;
		padding: 10px 10px 3px 0px;
		text-align: right;
	}
	.calendar-day > .events {
		cursor: pointer;
	}
	.calendar-day > .events > .event h4 {
		font-size: 12px;
		font-weight: 700;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		margin-bottom: 3px;
	}
	.calendar-day > .events > .event > .desc,
	.calendar-day > .events > .event > .location,
	.calendar-day > .events > .event > .datetime,
	.calendar-day > .events > .event > .attending {
		display: none;
	}
	.calendar-day > .events > .event > .progress {
		height: 10px;
	}
</style>
<!------ Include the above in your HEAD tag ---------->
<section id="calendar" style="padding-top: 50px; padding-bottom: 100px;">
<div style="padding: 0px 50px;">
    
    <h2 class="title">What is going on in <?php echo $cityidf['city_name']; ?></h2>
    
    <?php
        $currentMonth = date('F');
    ?>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <a href="#upcoming-events" class="btn btn-primary" style="height: 37px;">View List of Events</a>
        <h2 class="title"><?php echo $currentMonth; ?></h2>
        <a href="../add-event.php" class="btn btn-primary" style="height: 37px;">+ Add Event</a>
    </div>
    <?php
        $numCols = 7;
        $rowCount = 0;
        // $colWidth = 12 / $numCols;
    ?>

	<div class="calendar" data-toggle="calendar">
	    <div class="row">
    
	    <?php
            $numDaysInCurrentMonth = date('t') + 1;
            for($i = 1; $i < $numDaysInCurrentMonth; $i++){
                $rowCount++;
                $eventsq = mysqli_query($con, "SELECT * FROM `event` WHERE `city_id` = '$cityId' AND `event_approved` = 1");
                echo '<div class="col-xs-12 calendar-day" style="padding: 0px;">
        		<time datetime="">'.$i.'</time>';
                while($events = mysqli_fetch_array($eventsq)){
                    $eventDate = strtotime($events['start_date']);
                    $eventEndDate = strtotime($events['end_date']);
                    $eventMonth = date('F', $eventDate);
                    $eventDay = date('j', $eventDate);
                    $eventEndDay = date('j', $eventEndDate);
                    $interval = new DateInterval('P1D');
                    $period = new DatePeriod(new DateTime($events['start_date']), $interval, new DateTime($events['end_date']));
                    $allEventDates = [];
					if ($eventDate == $eventEndDate) {
						array_push($allEventDates, $eventDay);
					}
					foreach ($period as $key => $value) {
						array_push($allEventDates, $value->format('j'));
						array_push($allEventDates, $eventEndDay);
					}
                    if($eventMonth == $currentMonth && (in_array($i, $allEventDates))){
                        if($eventDay == $i){
                        echo '
                            <a href="event.php?id='.$events['id'].'">
            				<div class="events">
            					<div class="event" style="color: white; background-color: #7d9f6c; padding: 0px 10px; text-overflow: ellipsis; white-space: nowrap;">
            						<h4>'.$events['title'].'</h4>
            					</div>
            				</div>
            				</a>';
                        } else {
                            echo '
                            <a href="event.php?id='.$events['id'].'">
            				<div class="events">
            					<div class="event" style="color: white; background-color: #7d9f6c; padding: 0px 10px; text-overflow: ellipsis; white-space: nowrap;">
            						<h4 style="color: #7d9f6c; overflow: hidden;">'.$events['title'].'</h4>
            					</div>
            				</div>
            				</a>';
                        }
                    }
                }
                echo '
        			</div>
                ';
                
                if($rowCount % $numCols == 0) echo '</div><div class="row">';
                
            }
            
        ?>
		
	</div>
	</div>
	</section>
	