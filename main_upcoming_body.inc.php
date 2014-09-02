<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

if (SHOW_UPCOMING_TAB) {

	$ievent = 0;
	
	$todayTimeStamp = datetime2timestamp($today['year'],$today['month'],$today['day'],12,0,"am");
	
	// read all events for this week from the DB
	// TODO: Should only show next 365 days worth of events.
	$query = "SELECT e.id AS eventid, e.timebegin, e.timeend, e.sponsorid, e.title, e.location, e.description, e.wholedayevent, e.categoryid, c.id, c.name AS category_name FROM ".SCHEMANAME."vtcal_event_public e, ".SCHEMANAME."vtcal_category c ";
	$query.= "WHERE e.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND c.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND e.categoryid = c.id AND e.timeend > '".sqlescape($todayTimeStamp)."'";
	
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
	
	$query.= " ORDER BY e.timebegin ASC, e.wholedayevent DESC LIMIT " . MAX_UPCOMING_EVENTS;
	$result =& DBQuery($query );
	
	// Output an error message if $result is a string.
	if (is_string($result)) {
		DBErrorBox($result);
	}
	
	// Otherwise, the query was successful.
	else {
		?><!-- Start Upcoming Body -->
		<table id="DayTable" width="100%" cellpadding="6" cellspacing="0" border="0"><?php
	
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
				<td colspan="3" class="NoAnnouncement" valign="top"><?php echo lang('no_upcoming_events');?></td>
			</tr><?php
		}
		
		$previousDate = "";
		$previousWholeDay = false;
		$firstDaysEvent = true;
		$displayedFirstEvent = false;
		
		// print all events of one day
		while ($ievent < $result->numRows()) {
			// print event
	 	  disassemble_timestamp($event);	
			$datediff = Delta_Days($event['timebegin_month'],$event['timebegin_day'],$event['timebegin_year'],date("m", NOW),date("d", NOW),date("Y", NOW));
			$timediff = $event_timeend_num - $event_timebegin_num;
			$begintimediff = NOW_AS_TIMENUM - $event_timebegin_num;
			$endtimediff = NOW_AS_TIMENUM - $event_timeend_num;
			$EventHasPassed = ( $datediff > 0 || ( $datediff == 0 && $endtimediff > 0 ) );
			
			// Do not show events that have passed.
			if ( !$EventHasPassed ) {
			
				if ($previousDate != $event['timebegin_year'] . $event['timebegin_month'] . $event['timebegin_day']) {
					$previousWholeDay = false;
					$firstDaysEvent = true;
					$previousDate = $event['timebegin_year'] . $event['timebegin_month'] . $event['timebegin_day'];
					$formattedDateLabel = day_view_date_format($event['timebegin_day'], Day_of_Week_to_Text(Day_of_Week($event['timebegin_month'],$event['timebegin_day'],$event['timebegin_year'])),Month_to_Text($event['timebegin_month']),$event['timebegin_year']);
					$eventDayTimeStamp = datetime2timestamp($event['timebegin_year'],$event['timebegin_month'],$event['timebegin_day'],12,0,"am");
		
					?>
						<tr <?php if (!$displayedFirstEvent) { echo 'id="FirstDateRow"'; } ?>>
							<td colspan="2" class="DateRow"><div <?php
								if ( $todayTimeStamp == $eventDayTimeStamp ) {
									echo 'id="TodayDateRow"';
								}
							?>><?php
							
							if (!empty($_SESSION["AUTH_SPONSORID"])) {
								echo '<a class="NoPrint" href="addevent.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&timebegin_year='.$event['timebegin_year']."&timebegin_month=".$event['timebegin_month']."&timebegin_day=".$event['timebegin_day']."\" title=\"",lang('add_new_event'),"\">";
								echo '<img style="padding-right: 4px;" src="images/new.gif" height="16" width="16" alt="',lang('add_new_event'),'" border="0" align="left"></a>';
							}
							
							echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=day&timebegin=', urlencode($eventDayTimeStamp), $queryStringExtension ,'">';
							echo $formattedDateLabel;
							
							?></a></div></td>
						</tr>
					<?php
				}
				else {
					$firstDaysEvent = false;
				}
				
				// Start of Event Row
				echo '<tr valign="top" class="BorderTop">';
				
				// Start of Time Column
				echo '<td width="1%" align="right" valign="top" nowrap" class="TimeColumn">&nbsp;';
			
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
				echo '<td width="98%" class="DataColumn"><div class="EventLeftBar">';
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
			
				// Mark that the first event has been displayed.
				$displayedFirstEvent = true;
			}
	
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
} // end: if (SHOW_UPCOMING_TAB === TRUE)
?>
