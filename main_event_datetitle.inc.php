<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

if ( !is_string($result) && $result->numRows() > 0 ) {
	echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=day&amp;timebegin=', urlencode(datetime2timestamp($event_timebegin['year'],$event_timebegin['month'],$event_timebegin['day'],12,0,"am")) . $queryStringExtension . '">';
	echo day_view_date_format($event_timebegin['day'], Day_of_Week_to_Text(Day_of_Week($event_timebegin['month'],$event_timebegin['day'],$event_timebegin['year'])),Month_to_Text($event_timebegin['month']),$event_timebegin['year']);
	echo '</a>';
}
?>