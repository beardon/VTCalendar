<?php
require_once('application.inc.php');

$lang['no_managed_events'] = 'You have not submitted any events for the month of ';
$lang['show_events_for'] = 'Show events for';

if (!authorized()) { exit; }

pageheader(lang('manage_events'), "Update");
contentsection_begin(lang('manage_events'),true);

if (!isset($_GET['year']) || !setVar($year,$_GET['year'],'timebegin_year')) { $year = date("Y", NOW); }
if (!isset($_GET['month']) || !setVar($month,$_GET['month'],'timebegin_month')) { $month = date("n", NOW); }

// Create timestamps for the selected month.
$startTimestamp = datetime2timestamp($year, $month, 1, DAY_BEG_H, 0, "am");
$endTimestamp = datetime2timestamp($year + ($month == 12 ? 1 : 0), $month + ($month == 12 ? -11 : 1), 1, DAY_BEG_H, 0, "am");

$ievent = 0;
$today = Decode_Date_US(date("m/d/Y", NOW));
$today['timestamp_daybegin']=datetime2timestamp($today['year'],$today['month'],$today['day'],12,0,"am");

// Output list with events
$query =
	"SELECT calendarid = 'default' as isdefaultcal, calendarid as calendarid, id AS id,approved,rejectreason,timebegin,timeend,repeatid,sponsorid,displayedsponsor,displayedsponsorurl,title,wholedayevent,categoryid,description,location,price,contact_name,contact_phone,contact_email"
	." FROM ".TABLEPREFIX."vtcal_event WHERE sponsorid='".sqlescape($_SESSION["AUTH_SPONSORID"])."'"
	." AND timebegin >= '".sqlescape($startTimestamp)."' AND timeend < '".sqlescape($endTimestamp)."'"
	." ORDER BY timebegin DESC, wholedayevent DESC, id, isdefaultcal";

$result =& DBQuery($query);

if (is_string($result)) {
	DBErrorBox($result);
}
else {
	?>
	<form method="get" action="manageevents.php">
		<table  border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td><?php echo lang('show_events_for'); ?>:</td>
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
					<td><input type="submit" value="Show"></td>
		 		</tr>
				</table>
	</form>
	
	<p><a href="addevent.php"><?php echo lang('add_new_event'); ?></a> <?php if ($result->numRows() > 0) echo lang('or_manage_existing_events'); ?></p><?php
	
	if ($result->numRows() == 0) {
		echo '<p>' . lang('no_managed_events') . date("F, Y", mktime(0, 0, 0, $month, 15, $year)) . '.</p>';
	}
	else {
		$defaultcalendarname = getCalendarName('default');
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
		
				// keep track of repeat id and print recurring events only once
				if (!empty($event['repeatid'])) { 
					if ( isset($recurring_exists) && array_key_exists ($event['repeatid'].$event['calendarid'],$recurring_exists) ) { continue; }
					else { 
						// remember this recurring event
						$recurring_exists[$event['repeatid'].$event['calendarid']] = $event['repeatid'].$event['calendarid']; 
					}
				}
				
				if ($_SESSION['CALENDAR_ID'] == "default" || $event['isdefaultcal'] == 0)
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
						if ($_SESSION['CALENDAR_ID'] != "default" && $event['isdefaultcal'] == 1) {
							echo "This event was submitted to the &quot;".$defaultcalendarname."&quot; calendar";
							
							if (isset($PreviousEvent) && $PreviousEvent['title'] != $event['title']) {
								echo ',<br>but was renamed to: &quot;'.htmlentities($event['title']).'&quot;';
							}
							echo ".";
						}
						else {
							echo '<b>'.htmlentities($event['title']).'</b><br>';
							// output date
							echo Day_of_Week_Abbreviation(Day_of_Week($event['timebegin_month'],$event['timebegin_day'],$event['timebegin_year']));
							echo ", ";
							echo substr(Month_to_Text($event['timebegin_month']),0,3)," ",$event['timebegin_day'],", ",$event['timebegin_year'];
							echo " -- ";
							if ($event['wholedayevent']==0) {
								echo timestring($event['timebegin_hour'],$event['timebegin_min'],$event['timebegin_ampm']);
								if (endingtime_specified($event)) { // event has an explicit ending time
									echo " - ",timestring($event['timeend_hour'],$event['timeend_min'],$event['timeend_ampm']);
								}
							}
							else {
								echo lang('all_day');
							}
						
							if (!empty($event['repeatid'])) {
								echo "<br>\n";
								echo '<span class="NotificationText">';
								readinrepeat($event['repeatid'],$event,$repeat);
								$repeatdef = repeatinput2repeatdef($event,$repeat);
								printrecurrence($event['timebegin_year'],
									$event['timebegin_month'],
									$event['timebegin_day'],
									$repeatdef);
								echo '</span>';
							}
						}
						?></div></td>
					<td <?php if ($_SESSION['CALENDAR_ID'] != "default" && $event['isdefaultcal'] == 1) { echo 'style="padding-top: 0; padding-bottom: 7px;" colspan="2"'; } ?> bgcolor="<?php echo $color; ?>" valign="top">
						<?php
						if ($event['approved'] == -1) {
							echo '<font color="red"><b>rejected</b></font>';
							if (!empty($event['rejectreason'])) { echo "<br><b>Reason:</b> ",htmlentities($event['rejectreason']); }
						}
						elseif ($event['approved'] == 0) {
							echo '<font color="blue">',lang('submitted_for_approval'),'</font><br>';
						}
						elseif ($event['approved'] == 1) {
							echo '<font color="green">',lang('approved'),'</font><br>';
						}
						?></td>
					<?php
					if ($_SESSION['CALENDAR_ID'] == "default" || $event['isdefaultcal'] == 0) {
						?>
						<td <?php if ($_SESSION['CALENDAR_ID'] != "default" && $event['isdefaultcal'] == 1) { echo 'style="padding-top: 0; padding-bottom: 7px;"'; } ?> bgcolor="<?php echo $color; ?>" valign="top"><?php
								adminButtons($event, array('update','copy','delete'), "small", "horizontal");
							 ?></td>
						<?php
					}
					?>
				</tr>
				<?php
				$PreviousEvent['id'] = $event['id'];
				$PreviousEvent['title'] = $event['title'];
				$PreviousEvent['approved'] = $event['approved'];
			} // end: for ($i=0; $i<$result->numRows(); $i++)
		?>	
		</table>
	
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
	} // end: if ($result->numRows() > 0 )
}

contentsection_end();
pagefooter();
DBclose();

?>