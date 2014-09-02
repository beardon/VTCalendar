<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

$ievent = 0;

// read all events for this week from the DB
$query = "SELECT e.id AS eventid,e.timebegin,e.timeend,e.sponsorid,e.title,e.location,e.wholedayevent,e.categoryid,c.id,c.name AS category_name FROM vtcal_event_public e, vtcal_category c WHERE e.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND c.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND e.categoryid = c.id AND e.timebegin >= '".sqlescape($weekfrom['timestamp'])."' AND e.timeend <= '".sqlescape($weekto['timestamp'])."'";
if ($sponsorid != "all")  { $query.= " AND (e.sponsorid='".sqlescape($sponsorid)."')"; }

if ( isset($CategoryFilter) && count($CategoryFilter) > 0 ) {
	$query.= " AND (";
	for($c=0; $c < count($CategoryFilter); $c++) {
		if ($c > 0) { $query.=" OR "; }
		$query.= "(e.categoryid='".sqlescape($CategoryFilter[$c])."')";
	}
	$query.= ")";
}
else {
	 if (isset($categoryid) && $categoryid != 0) { $query.= " AND (e.categoryid='".sqlescape($categoryid)."')"; }
}

if (!empty($keyword)) { $query.= " AND ((e.title LIKE '%".sqlescape($keyword)."%') OR (e.description LIKE '%".sqlescape($keyword)."%'))"; }
$query.= " ORDER BY e.timebegin ASC, e.wholedayevent DESC";
$result =& DBQuery($query );

 // Output an error message if $result is a string.
if (is_string($result)) {
	DBErrorBox($result);
}
	
// Otherwise, the query was successful.
else {
	?><!-- Start Week Body -->
	<table id="WeekdayTable" width="100%" cellpadding="4" cellspacing="0" border="0">
	
	<!-- Start Column Headers -->
	<thead>
	<tr>
	<?php
	// print the days of the week in the header of the table
	for ($weekday=0; $weekday <= 6; $weekday++) {
		
		$iday = Add_Delta_Days($weekfrom['month'],$weekfrom['day'],$weekfrom['year'],$weekday);
		$datediff = Delta_Days($iday['month'],$iday['day'],$iday['year'],date("m", NOW),date("d", NOW),date("Y", NOW));

		echo '<td valign="top" align="center"';
		if ($datediff == 0) {
			echo ' class="Weekday-Today"';
		}
		echo ' nowrap>';
		echo "<div><b>";
		echo Day_of_Week_to_Text(($weekday+$week_start)%7); // use modulus 7 as week can begin with Sunday or Monday
		echo "<br>\n";
		echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=day&timebegin=', urlencode(datetime2timestamp($iday['year'],$iday['month'],$iday['day'],12,0,"am")), $queryStringExtension ,'">' . week_header_date_format($iday['day'],Month_to_Text($iday['month']),0,3) . "</a></b></div>";

		if (!empty($_SESSION["AUTH_SPONSORID"])) { // display "add event" icon
			echo '<div style="padding-top: 3px;"><a href="addevent.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&timebegin_year='.$iday['year']."&timebegin_month=".$iday['month']."&timebegin_day=".$iday['day']."\" title=\"",lang('add_new_event'),"\">";
			echo '<img src="images/new.gif" height="16" width="16" alt="',lang('add_new_event'),'" border="0"></a></div>';
		}

		echo "</td>\n";
	}
	?>		
	</tr>
	</thead>
	<!-- End Column Headers -->
	
	<!-- Start Weekday Events -->
	<tbody>
	<tr>
	<?php

	// read first event if one exists
	if ($ievent < $result->numRows()) {
		$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
		$event_timebegin  = timestamp2datetime($event['timebegin']);
		$event_timeend    = timestamp2datetime($event['timeend']);
	}
	
	// output event info for every day
	for ($weekday = 0; $weekday <= 6; $weekday++) {
		$events_per_day = 0;
		$iday = Add_Delta_Days($weekfrom['month'],$weekfrom['day'],$weekfrom['year'],$weekday);
		$datediff = Delta_Days($iday['month'],$iday['day'],$iday['year'],date("m", NOW),date("d", NOW),date("Y", NOW));
		
		$iday['timebegin'] = datetime2timestamp($iday['year'],$iday['month'],$iday['day'],0,0,"am");
		$iday['timeend']   = datetime2timestamp($iday['year'],$iday['month'],$iday['day'],11,59,"pm");
		
		echo '<td';
		
		if ($datediff > 0) {
			echo ' class="Weekday-Past"';
		}
		elseif ($datediff == 0) {
			echo ' class="Weekday-Today"';
		}
		
		echo ' valign="top">';
		
		$event['classExtension'] = "";

		// print all events of one day
		while (($ievent < $result->numRows())
					 &&
					 ($event_timebegin['year']==$iday['year']) &&
					 ($event_timebegin['month']==$iday['month']) &&
					 ($event_timebegin['day']==$iday['day'])) {
			
			// Increment the number of events that have happened on this day.
			$events_per_day++;
			
			$event_timebegin_num = timestamp2timenumber($event['timebegin']);
			$event_timeend_num = timestamp2timenumber($event['timeend']);
			$begintimediff = NOW_AS_TIMENUM - $event_timebegin_num;
			$endtimediff = NOW_AS_TIMENUM - $event_timeend_num;
			$event['timelabel'] = timenumber2timelabel($event_timeend_num - $event_timebegin_num);
			$EventHasPassed = ( $datediff > 0 || ( $datediff == 0 && $endtimediff > 0 ) );
			
			if ($EventHasPassed) {
				$event['classExtension'] = "-Past";
			}
			
			// print event
			print_week_event($event);

			// read next event if one exists
			$ievent++;
			if ($ievent < $result->numRows()) {
				$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
				$event_timebegin  = timestamp2datetime($event['timebegin']);
				$event_timeend    = timestamp2datetime($event['timeend']);
				$event['classExtension'] = "";
			}
		} // end: while (...)
		
		// Make sure there is something in the column to prevent older browsers from having display problems.
		if ( $events_per_day < 1 ) { echo "&nbsp;"; }
		
		echo "</td>\n";
	}
	?>
	</tr>
	</tbody>
	<!-- End Weekday Events -->
	
	</table>
	<!-- End Week Body --><?php
	
	if ( !empty($_SESSION["AUTH_SPONSORID"])) {
		?><table border="0" cellpadding="3" cellspacing="0">
			<tr>
				<td><img src="images/new.gif" height="16" width="16" alt="" border="0"></td>
				<td>= <?php echo lang('add_new_event'); ?></td>
			</tr>
		</table><?php
	}
}

// prints one event in the format of the week view
function print_week_event(&$event) {
	global $day_end_h;
	disassemble_timestamp($event);
	$event_timebegin  = timestamp2datetime($event['timebegin']);
	$event_timeend    = timestamp2datetime($event['timeend']);

	echo '<div class="WeekEvent' . $event['classExtension'] . '">';
	
	echo '<div class="WeekEvent-Time">';
	if ($event['wholedayevent']==0) {
		echo timestring($event['timebegin_hour'],$event['timebegin_min'],$event['timebegin_ampm']);
		if ( ! ($event['timeend_hour']==$day_end_h && $event['timeend_min']==59) ) {
			echo ' ('. $event['timelabel'] .')';
		}
	}
	else {
		echo lang('all_day');
	}
	echo '</div>';
	
	echo '<div class="WeekEvent-Title"><b>';
	echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=event&eventid=',$event['eventid'],'&timebegin=';
	echo urlencode(datetime2timestamp($event_timebegin['year'],$event_timebegin['month'],$event_timebegin['day'],12,0,"am"));
	echo $queryStringExtension, '">';
	echo htmlentities($event['title']);
	echo "</a>";
	
	echo '</b></div>';
 	
 	//if ($preview != 1) {
		// echo '<div class="WeekEvent-Category">' . $event['category_name'] . '</div>';
		//if (!empty($event['location'])) {
			echo '<div class="WeekEvent-Category">' . htmlentities($event['location']) . '</div>';
		//}
	//};
	echo "</div>\n";
} // end: function print_week_event(&$event)
?>