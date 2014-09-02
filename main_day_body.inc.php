<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

$ievent = 0;

// read all events for this week from the DB
$query = "SELECT e.id AS eventid,e.timebegin,e.timeend,e.sponsorid,e.title,e.location,e.description,e.wholedayevent,e.categoryid,c.id,c.name AS category_name FROM ".SCHEMANAME."vtcal_event_public e, ".SCHEMANAME."vtcal_category c ";
$query.= "WHERE e.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND c.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND e.categoryid = c.id AND e.timebegin >= '".sqlescape($showdate['timestamp_daybegin'])."' AND e.timeend <= '".sqlescape($showdate['timestamp_dayend'])."'";

// Filter by sponsor ID if one was specified.
if ($sponsorid != "all")  { $query.= " AND (e.sponsorid='".sqlescape($sponsorid)."')"; }

// Filter by categories if one or more were specified.
if ( isset($CategoryFilter) && count($CategoryFilter) > 0 ) {
	$query.= " AND (";
	for($c=0; $c < count($CategoryFilter); $c++) {
		if ($c > 0) { $query.=" OR "; }
		$query.= "(e.categoryid='".sqlescape($CategoryFilter[$c])."')";
	}
	$query.= ")";
}
else {
	 if ($categoryid != 0) { $query.= " AND (e.categoryid='".sqlescape($categoryid)."')"; }
}

// Filter by keyword if one was specified from the search form.
if (!empty($keyword)) { $query.= " AND ((e.title LIKE '%".sqlescape($keyword)."%') OR (e.description LIKE '%".sqlescape($keyword)."%'))"; }

$query.= " ORDER BY e.timebegin ASC, e.wholedayevent DESC";
$result =& DBQuery($query );

// Output an error message if $result is a string.
if (is_string($result)) {
	DBErrorBox($result);
}

// Otherwise, the query was successful.
else {

	// Admin controls
	if (!empty($_SESSION["AUTH_SPONSORID"])) {
		?><div style="padding: 5px;"><?php adminButtons($showdate, array('new'), "normal", "horizontal"); ?></div><?php
	}
	
	?><!-- Start Day Body --><table id="DayTable" width="100%" cellpadding="6" cellspacing="0" border="0"><?php

	// read first event if one exists
	if ($ievent < $result->numRows()) {
		$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
		$event_timebegin  = timestamp2datetime($event['timebegin']);
		$event_timeend    = timestamp2datetime($event['timeend']);
		$event_timebegin_num = timestamp2timenumber($event['timebegin']);
		$event_timeend_num = timestamp2timenumber($event['timeend']);
	}
	else { ?>
		<tr>
			<td colspan="3" class="NoAnnouncement" valign="top"><?php echo lang('no_events');?></td>
		</tr><?php
	} // end: else: if ($ievent < $result->numRows())

	$previousWholeDay = false;
	
	// print all events of one day
	while ($ievent < $result->numRows()) {
		// print event
 	  disassemble_timestamp($event);	
		$datediff = Delta_Days($event['timebegin_month'],$event['timebegin_day'],$event['timebegin_year'],date("m",NOW),date("d",NOW),date("Y",NOW));
		$timediff = $event_timeend_num - $event_timebegin_num;
		$begintimediff = NOW_AS_TIMENUM - $event_timebegin_num;
		$endtimediff = NOW_AS_TIMENUM - $event_timeend_num;
		$EventHasPassed = ( $datediff > 0 || ( $datediff == 0 && $endtimediff > 0 ) );
		
		// Start of Event Row
		echo '<tr valign="top"';
		if ( $ievent != 0 && $event['wholedayevent']==0 ) {
			echo ' class="BorderTop"';
		}
		echo ">\n";
		
		// Start of Time Column
		echo '<td width="1%" align="right" valign="top" nowrap"';
		if ( $EventHasPassed ) {
			echo ' class="TimeColumn-Past"'; }
		else {
			echo ' class="TimeColumn"'; }
		echo ">&nbsp;";
		
		// Time of the Event
		if ($event['wholedayevent']==0) {
			echo timestring($event['timebegin_hour'],$event['timebegin_min'],$event['timebegin_ampm']);
			if ( ! ($event['timeend_hour']==DAY_END_H && $event['timeend_min']==59) ) {
				echo "<br><i>";
				echo timenumber2timelabel($event_timeend_num - $event_timebegin_num);
				echo "</i>";
			}
		}
		// "All Day" marker
		else {
			if (!$previousWholeDay ) { echo lang('all_day'); }
			$previousWholeDay = true;
		}
		
		// End of Time Column
		echo "</td>\n";
		
		// Start Data Column
		echo '<td width="98%"';
		if ( $EventHasPassed ) {
			echo ' class="DataColumn-Past"'; }
		else {
			echo ' class="DataColumn"'; }
		
		echo '><div class="EventLeftBar">';
		echo '<b><a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=event&eventid=',$event['eventid'],'&timebegin=';
		echo urlencode(datetime2timestamp($event_timebegin['year'],$event_timebegin['month'],$event_timebegin['day'],12,0,"am"));
		echo '">',htmlentities($event['title']),"</a></b> ";
		if ( !empty($event['location']) ) { echo " - ",htmlentities($event['location']); }
		/*echo " -- <i>".htmlentities($event['category_name'])."</i>";*/
		echo "<br>";
		
		if (!empty($event['description'])) {
			if (strlen($event['description']) < 140 ) {
				echo htmlentities($event['description']);
			} 
			else {
				echo substr($event['description'],0,140);
				echo "... \n";
				echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=event&eventid=',$event['eventid'],'&timebegin=';
				echo urlencode(datetime2timestamp($event_timebegin['year'],$event_timebegin['month'],$event_timebegin['day'],12,0,"am"));
				echo '">more</a>';
			}
			echo " \n";
		}
		else {
			echo "<br>\n";
		}
		echo "</div></td>\n";
		// End Data Column
		
		echo "</tr>\n";
		// End of Event Row

		// read next event if one exists
		$ievent++;
		if ($ievent < $result->numRows()) {
			$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
			$event_timebegin  = timestamp2datetime($event['timebegin']);
			$event_timeend    = timestamp2datetime($event['timeend']);
			$event_timebegin_num = timestamp2timenumber($event['timebegin']);
			$event_timeend_num = timestamp2timenumber($event['timeend']);
		}
	} // end: while (...)

	?></table><!-- End Day Body --><?php
} 
?>