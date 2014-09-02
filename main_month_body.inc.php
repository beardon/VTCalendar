<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files
	
	$ievent = 0;
	// Create base query to retrieve all events for this month
	$query = "SELECT e.id AS eventid,e.timebegin,e.timeend,e.sponsorid,e.title,e.wholedayevent,e.categoryid,c.id,c.name AS category_name FROM ".TABLEPREFIX."vtcal_event_public e, ".TABLEPREFIX."vtcal_category c ";
	$query .= "WHERE e.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND c.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND e.categoryid = c.id AND e.timebegin >= '".sqlescape($monthstart['timestamp'])."' AND e.timeend <= '".sqlescape($monthend['timestamp'])."'";
	
	// Filter by sponsor if necessary
	if ($sponsorid != "all") { $query.= " AND (e.sponsorid='".sqlescape($sponsorid)."')"; }

	// Filter by category filters if necessary
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
	
	// Filter the results by a keyword from the search form.
	if (!empty($keyword)) { $query.= " AND ((e.title LIKE '%".sqlescape($keyword)."%') OR (e.description LIKE '%".sqlescape($keyword)."%'))"; }
	$query.= " ORDER BY e.timebegin ASC, e.wholedayevent DESC";
	$result =& DBQuery($query ); 
	
	// Output an error message if $result is a string.
	if (is_string($result)) {
		DBErrorBox($result);
	}
	
	// Otherwise, the query was successful.
	else {
		?>
		<!-- Start Month Body -->
		<table id="MonthTable" width="100%" border="0" cellpadding="3" cellspacing="0">
			<thead>
				<tr align="center">
					<?php if(WEEK_STARTING_DAY == 0){?>
					<td><strong><?php echo lang('sunday');?></strong></td>
					<?php } ?>
					<td><strong><?php echo lang('monday');?></strong></td>
					<td><strong><?php echo lang('tuesday');?></strong></td>
					<td><strong><?php echo lang('wednesday');?></strong></td>
					<td><strong><?php echo lang('thursday');?></strong></td>
					<td><strong><?php echo lang('friday');?></strong></td>
					<td><strong><?php echo lang('saturday');?></strong></td>
					<?php if(WEEK_STARTING_DAY == 1){?>
					<td><strong><?php echo lang('sunday');?></strong></td>
					<?php } ?>
				</tr>
			</thead>
			
			<tbody>
		<?php
	
		// Read first event if it exists.
		if ($ievent < $result->numRows()) {
			$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
			$event_timebegin  = timestamp2datetime($event['timebegin']);
			$event_timeend    = timestamp2datetime($event['timeend']);
		}
	
		// Loop through the 6 possible rows for each week.
		// If less rows are necessary, 
		for ($iweek=1; $iweek<=6; $iweek++) {
			
			// Determine the first day of the week
			$weekstart = Add_Delta_Days($monthstart['month'],$monthstart['day'],$monthstart['year'],($iweek-1)*7);
			$weekstart['timestamp'] = datetime2timestamp($weekstart['year'],$weekstart['month'],$weekstart['day'],12,0,"am");
			
			// Output only the weeks where the first day is in the current month (excluding the first week)
			if ($iweek == 1 || $weekstart['month'] == $month['month']) {
				echo "<tr>\n";
	
				// Output each day for the week.
				for ($weekday = 0; $weekday <= 6; $weekday++) {
				
					// Calculate the day's date information.
					$iday = Add_Delta_Days($monthstart['month'],$monthstart['day'],$monthstart['year'],($iweek-1)*7+$weekday);
					$iday['timebegin'] = datetime2timestamp($iday['year'],$iday['month'],$iday['day'],0,0,"am");
					$iday['timeend']   = datetime2timestamp($iday['year'],$iday['month'],$iday['day'],11,59,"pm");
					
					// Determine the number of days between the day and the current date.
					$datediff = Delta_Days($iday['month'],$iday['day'],$iday['year'],date("m", NOW),date("d", NOW),date("Y", NOW));
					
					echo "<td ";
					
					// Set the CSS class for how the day should be styled.
					if ($month['month'] != $iday['month']) {
						echo 'class="MonthDay-OtherMonth" ';
					}
					elseif ($datediff > 0) {
						echo 'class="MonthDay-Past" ';
					}
					elseif ($datediff == 0) {
						echo 'class="MonthDay-Today" ';
					}
					else {
						echo 'class="MonthDay-Future" ';
					}
					
					echo 'valign="top">';
					
					// Do not display events that are not in the current month.
					// TODO: Change this so the query does not pull the events in the first place.
					if (!SHOW_MONTH_OVERLAP && $month['month'] != $iday['month']) {
						echo "&nbsp;";
					}
					else {
						// Output a table with the day's number.
						echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>';
						
						// Display an "add event" icon
						if (!empty($_SESSION["AUTH_SPONSORID"])) {
							echo '<td class="NoPrint"><a style="font-size: 11px;" href="addevent.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&timebegin_year='.$iday['year']."&timebegin_month=".$iday['month']."&timebegin_day=".$iday['day']."\" title=\"",lang('add_new_event'),"\">";
							echo '<img src="images/new.gif" height="16" width="16" title="',lang('add_new_event'),'" alt="',lang('add_new_event'),'" border="0">';
							echo '</a></td>';
						}
						
						echo '<td width="100%"><div class="DayNumber"><b><a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=day&timebegin=',urlencode(datetime2timestamp($iday['year'],$iday['month'],$iday['day'],12,0,"am")),$queryStringExtension,'">';
						echo $iday['day'];
						echo "</a></b></div></td>";
						echo "</tr></table>";
					}
					
					// Output all the events for the day.
					while (($ievent < $result->numRows()) &&
								 ($event_timebegin['year']==$iday['year']) &&
								 ($event_timebegin['month']==$iday['month']) &&
								 ($event_timebegin['day']==$iday['day'])) {
						
						// Only display events that are in the current month.
						// TODO: Change so the query does not pull the events in the first place.
						if (SHOW_MONTH_OVERLAP || $month['month'] == $iday['month']) {
						
							$event_timebegin_num = timestamp2timenumber($event['timebegin']);
							$event_timeend_num = timestamp2timenumber($event['timeend']);
							$begintimediff = NOW_AS_TIMENUM - $event_timebegin_num;
							$endtimediff = NOW_AS_TIMENUM - $event_timeend_num;
							$EventHasPassed = ( $datediff > 0 || ( $datediff == 0 && $endtimediff > 0 ) );
							
							// If the event has passed, use the correct CSS class.
							if ($EventHasPassed) {
								$event['classExtension'] = "-Past";
							}
							else {
								$event['classExtension'] = "";
							}
							
							// Output the event data.
							echo '<p class="EventItem'.$event['classExtension'].'"><a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=event&eventid=',$event['eventid'],'&timebegin=';
							echo urlencode(datetime2timestamp($event_timebegin['year'],$event_timebegin['month'],$event_timebegin['day'],12,0,"am"));
							echo '">',htmlentities($event['title']),'</a></p>';
							
						}
						
						// Read the next event
						$ievent++;
						if ($ievent < $result->numRows()) {
							$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
							$event_timebegin  = timestamp2datetime($event['timebegin']);
							$event_timeend    = timestamp2datetime($event['timeend']);
						}
					}
					
					echo "</td>\n";
				}
				
				echo "</tr>\n";
			}
		}
	
	?>
	</tbody>
	</table>
	
	<!-- Output a key for the admin buttons -->
	<?php if (!empty($_SESSION["AUTH_SPONSORID"])) { ?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr>
			<td><img src="images/new.gif" height="16" width="16" alt="" border="0"></td>
			<td>= <?php echo lang('add_new_event'); ?></td>
		</tr>
	</table>
	<?php } ?>
	<!-- End Month Body --><?php
}
?>