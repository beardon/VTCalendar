<?php
require_once('application.inc.php');

if (!authorized()) { exit; }

pageheader(lang('manage_events'), "Update");
contentsection_begin(lang('manage_events'),true);

if (!isset($_GET['year']) || !setVar($year,$_GET['year'],'timebegin_year')) { $year = date("Y", NOW); }
if (!isset($_GET['month']) || !setVar($month,$_GET['month'],'timebegin_month')) { $month = date("n", NOW); }
if (!isset($_GET['timebegin']) || !setVar($timebegin,$_GET['timebegin'],'timebegin')) { unset($timebegin); }

if (isset($timebegin)) {
	$year = intval(substr($timebegin, 0, 4));
	$month = intval(substr($timebegin, 5, 2));
}

// Create timestamps for the selected month.
$startTimestamp = datetime2timestamp($year, $month, 1, DAY_BEG_H, 0, "am");
$endTimestamp = datetime2timestamp($year + ($month == 12 ? 1 : 0), $month + ($month == 12 ? -11 : 1), 1, DAY_BEG_H, 0, "am");

$ievent = 0;
$today = Decode_Date_US(date("m/d/Y", NOW));
$today['timestamp_daybegin']=datetime2timestamp($today['year'],$today['month'],$today['day'],12,0,"am");

// Event list with one-time events
$query =
	"SELECT *, calendarid = 'default' as isdefaultcal"
	." FROM ".SCHEMANAME."vtcal_event WHERE sponsorid='".sqlescape($_SESSION["AUTH_SPONSORID"])."'"
	." AND timebegin >= '".sqlescape($startTimestamp)."' AND timeend < '".sqlescape($endTimestamp)."' AND repeatid = ''"
	." ORDER BY timebegin, wholedayevent DESC, id, isdefaultcal";
$singleresult =& DBQuery($query);

// Event list with repeating events
$query =
	"SELECT e.*, e.calendarid = 'default' as isdefaultcal, r.repeatdef, r.startdate, r.enddate"
	." FROM ".SCHEMANAME."vtcal_event e JOIN ".SCHEMANAME."vtcal_event_repeat r ON e.repeatid = r.id"
	." WHERE e.sponsorid='".sqlescape($_SESSION["AUTH_SPONSORID"])."' AND e.timebegin >= '".sqlescape($startTimestamp)."' AND e.timeend < '".sqlescape($endTimestamp)."' AND e.repeatid != ''"
	." ORDER BY e.repeatid, isdefaultcal, e.timebegin, e.wholedayevent DESC, e.id";
$repeatresult =& DBQuery($query);

if (is_string($singleresult)) {
	DBErrorBox($singleresult);
}
elseif (is_string($repeatresult)) {
	DBErrorBox($repeatresult);
}
else {
	?>
	<form method="get" action="manageevents.php">
		<table border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td><?php echo lang('show_events_for'); ?>:</td>
					
					<?php
					$dateresults =& DBQuery("SELECT substr(timebegin,1,7) as yearmonth, count(*) as eventcount FROM ".SCHEMANAME."vtcal_event WHERE sponsorid='".sqlescape($_SESSION["AUTH_SPONSORID"])."' GROUP BY 1 ORDER BY 1 DESC");
					if (is_string($dateresults)) {
						?>
							<td><select name="month">
								<?php
								for ($m = 1; $m <= 12; $m++) {
									echo '<option value="' . $m . '"';
									if ($month == $m) echo " SELECTED";
									echo '>' . Month_to_Text($m) . '</option>';
								}
								?>
							</select></td>
							<td><select name="year">
								<?php
								$currentyear = date("Y", NOW);
								for ($y = 1990; $y <= $currentyear + 10; $y++) {
									echo '<option';
									if ($year == $y) echo " SELECTED";
									echo '>' . $y . '</option>';
								}
								?>
							</select></td>
						<?php
					}
					else {
						?>
						<td><select name="timebegin">
								<?php
								$currentMonth = date("Y-m", NOW);
								for ($i=0; $i<$dateresults->numRows(); $i++) {
									$dateinfo =& $dateresults->fetchRow(DB_FETCHMODE_ASSOC,$i);
									
									if ($currentMonth !== true) {
										if ($currentMonth == $dateinfo['yearmonth']) {
											$currentMonth = true;
										}
										elseif ($currentMonth > $dateinfo['yearmonth']) {
											echo "AXX";
											echo '<option value="' . $currentMonth . '-01 00:00:00"';
											if ($year == substr($currentMonth, 0, 4) && $month == intval(substr($currentMonth, 5, 2))) echo " SELECTED";
											echo '>' . Month_to_Text(intval(substr($currentMonth, 5, 2))) . ', ' . substr($currentMonth, 0, 4) . ' (0)</option>';
											$currentMonth = true;
										}
									}
									
									echo '<option value="' . $dateinfo['yearmonth'] . '-01 00:00:00"';
									if ($year == substr($dateinfo['yearmonth'], 0, 4) && $month == intval(substr($dateinfo['yearmonth'], 5, 2))) echo " SELECTED";
									echo '>' . Month_to_Text(intval(substr($dateinfo['yearmonth'], 5, 2))) . ', ' . substr($dateinfo['yearmonth'], 0, 4) . ' (' . $dateinfo['eventcount'] . ')</option>';
								}
								$dateresults->free();
								
								if ($currentMonth !== true) {
									echo '<option value="' . $currentMonth . '-01 00:00:00"';
									if ($year == substr($currentMonth, 0, 4) && $month == intval(substr($currentMonth, 5, 2))) echo " SELECTED";
									echo '>' . Month_to_Text(intval(substr($currentMonth, 5, 2))) . ', ' . substr($currentMonth, 0, 4) . ' (0)</option>';
									$currentMonth = true;
								}
								?>
							</select></td>
						<?php
					}
					?>
					
					<td><input type="submit" value="Show"></td>
		 		</tr>
		</table>
	</form>
	
	<p><a href="addevent.php"><?php echo lang('add_new_event'); ?></a> <?php if ($singleresult->numRows() > 0 || $repeatresult->numRows() > 0) echo lang('or_manage_existing_events'); ?></p><?php
	
	$defaultcalendarname = getCalendarName('default');
	
	?><h2 style="padding-bottom: 12px;"><?php echo lang('one_time_events'); ?>:&nbsp;</h2><?php
	
	OutputManagedEvents("single", $singleresult, $defaultcalendarname, $month, $year);
	
	?><h2 style="padding-top: 12px; padding-bottom: 12px;"><?php echo lang('reoccurring_events'); ?>:&nbsp;</h2><?php
	
	OutputManagedEvents("repeat", $repeatresult, $defaultcalendarname, $month, $year);
		
	?>
	<br><b><?php echo lang('status_info_message'); ?></b><br>
	<table border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td><font color="red"><b><?php echo lang('rejected'); ?></b></font></td>
		<td><?php echo lang('rejected_explanation'); ?></td>
	<tr>
		<td><font color="blue"><?php echo lang('submitted_for_approval'); ?></font></td>
		<td><?php echo lang('submitted_for_approval_explanation'); ?></td>
	<tr>
		<td><font color="green"><?php echo lang('approved'); ?></font></td>
		<td><?php echo lang('approved_explanation'); ?></td>
	</tr></table>
	<?php
}

function OutputManagedEvents($mode, &$result, $defaultcalendarname, $month, $year) {
	
	if ($result->numRows() == 0) {
		echo '<p>' . lang('no_managed_events') . date("F, Y", mktime(0, 0, 0, $month, 15, $year)) . '.</p>';
	}
	else {
		?>
		<table border="0" cellspacing="0" cellpadding="4">
			<tr class="TableHeaderBG">
				<td><b><?php echo lang('title'); ?>/<?php echo lang('date'); ?>/<?php echo lang('time'); ?></b></td>
				<td><b><?php echo lang('status'); ?></b></td>
				<td>&nbsp;</td>
			</tr>
			<?php
			$color = $_SESSION['COLOR_LIGHT_CELL_BG'];
			for ($i=0; $i<$result->numRows(); $i++) {
				$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
				disassemble_timestamp($event);
				
				// Skip this event if this event is from the "default" calendar
				// but is not following its corresponding event from this calendar or has yet to be approved.
				if ($_SESSION['CALENDAR_ID'] != "default" && $event['isdefaultcal'] == 1 && (!isset($PreviousEvent) || $event['id'] != $PreviousEvent['id'] || $PreviousEvent['approved'] == 0)) {
					continue;
				}
				
				if ($event['approved'] == -1) {
					$status = '<font color="red"><b>'.lang('rejected').'</b></font>';
					if (!empty($event['rejectreason'])) { $status .= "<br><b>".lang('rejected_reason').":</b> ".htmlentities($event['rejectreason']); }
				}
				elseif ($event['approved'] == 0) {
					$status = '<font color="blue">'.lang('submitted_for_approval').'</font><br>';
				}
				elseif ($event['approved'] == 1) {
					$status = '<font color="green">'.lang('approved').'</font><br>';
				}
				
				if ($event['repeatid'] != '') {
					
					if (!isset($PreviousEvent) || $event['repeatid'] != $PreviousEvent['repeatid']) {
						if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] )
							{ $color = $_SESSION['COLOR_BG']; }
						else
							{ $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
						
						?>	
						<tr>
							<td bgcolor="<?php echo $color; ?>"><?php
							echo '<b>'.htmlentities($event['title']).'</b><br>';
							
							// Output repeating event details.
							echo '<span class="NotificationText">';
							
							repeatdef2repeatinput($event['repeatdef'],$event,$repeat);
							$startdate = timestamp2datetime($event['startdate']);
							printrecurrence($startdate['year'],
								$startdate['month'],
								$startdate['month'],
								$event['repeatdef']);
							echo '</span>';
							?></td>
							<td bgcolor="<?php echo $color; ?>"><?php echo $status; ?></td>
							<td bgcolor="<?php echo $color; ?>"><?php
								adminButtons($event, array('update','copy','delete'), "small", "horizontal");
							?></td>
						</tr>
						<?php
					}
				}
				elseif ($_SESSION['CALENDAR_ID'] == "default" || $event['isdefaultcal'] == 0)
				{
					if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] )
						{ $color = $_SESSION['COLOR_BG']; }
					else
						{ $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
				}
				
				?>	
				<tr bgcolor="<?php echo $color; ?>">
					<td <?php if ($_SESSION['CALENDAR_ID'] != "default" && $event['isdefaultcal'] == 1) { echo 'style="padding-top: 0; padding-bottom: 7px;" class="DefaultCalendarEvent"'; } ?> bgcolor="<?php echo $color; ?>" valign="top">
						<div>
						<?php
						
						// Output a simple message notifying the user that their event was submitted to the default calendar.
						if ($_SESSION['CALENDAR_ID'] != "default" && $event['isdefaultcal'] == 1) {
							echo str_replace('%DEFAULTCALNAME%', $defaultcalendarname, lang('submitted_to_default_calendar'));
							
							if (isset($PreviousEvent) && $PreviousEvent['title'] != $event['title']) {
								echo str_replace('%TITLE%', htmlentities($event['title']), lang('submitted_to_default_calendar_but_renamed'));
							}
							
							echo ".";
							
							// Unset PreviousEvent to avoid this message appearing multiple times.
							unset($PreviousEvent);
						}
						
						// Output the details for an event that is part of this calendar.
						else {
							
							if ($event['repeatid'] == '') {
								echo '<b>'.htmlentities($event['title']).'</b><br>';
							}
							
							// output date
							echo Day_of_Week_Abbreviation(Day_of_Week($event['timebegin_month'],$event['timebegin_day'],$event['timebegin_year']));
							echo ", ";
							echo substr(Month_to_Text($event['timebegin_month']),0,3)," ",$event['timebegin_day'],", ",$event['timebegin_year'];
							echo " -- ";
							
							// output time
							if ($event['wholedayevent']==0) {
								echo timestring($event['timebegin_hour'],$event['timebegin_min'],$event['timebegin_ampm']);
								if (endingtime_specified($event)) { // event has an explicit ending time
									echo " - ",timestring($event['timeend_hour'],$event['timeend_min'],$event['timeend_ampm']);
								}
							}
							else {
								echo lang('all_day');
							}
						}
						?></div></td>
					
					<td <?php if ($_SESSION['CALENDAR_ID'] != "default" && $event['isdefaultcal'] == 1) { echo 'style="padding-top: 0; padding-bottom: 7px;" colspan="2"'; } ?>
						bgcolor="<?php echo $color; ?>"
						valign="top"><?php echo ($_SESSION['CALENDAR_ID'] != "default" && $event['isdefaultcal'] == 1 || $event['repeatid'] == '') ? $status : "&nbsp;"; ?></td>
					
					<?php
					if ($_SESSION['CALENDAR_ID'] == "default" || $event['isdefaultcal'] == 0) {
						?>
						<td <?php if ($_SESSION['CALENDAR_ID'] != "default" && $event['isdefaultcal'] == 1) { echo 'style="padding-top: 0; padding-bottom: 7px;"'; } ?> bgcolor="<?php echo $color; ?>" valign="top"><?php
								adminButtons($event, ($event['repeatid'] != '') ? array('delete') : array('update','copy','delete'), "small", "horizontal");
							 ?></td>
						<?php
					}
					?>
				</tr>
				<?php
				$PreviousEvent['id'] = $event['id'];
				$PreviousEvent['title'] = $event['title'];
				$PreviousEvent['approved'] = $event['approved'];
				$PreviousEvent['repeatid'] = $event['repeatid'];
				$PreviousEvent['isdefaultcal'] = $event['isdefaultcal'];
			}
		?>
		</table>
		<?php
	}
}

contentsection_end();
pagefooter();
DBclose();

?>