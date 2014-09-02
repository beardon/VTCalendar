<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

	pageheader(lang('reject_event_update'), "Update");
	contentsection_begin(lang('reject_event_update'));

	$query = "SELECT e.id AS id,e.timebegin,e.timeend,e.repeatid,e.sponsorid,e.displayedsponsor,e.displayedsponsorurl,e.title,e.wholedayevent,e.categoryid,e.description,e.location,e.price,e.contact_name,e.contact_phone,e.contact_email,c.id AS cid,c.name AS category_name,s.id AS sid,s.name AS sponsor_name,s.url AS sponsor_url FROM ".SCHEMANAME."vtcal_event e, ".SCHEMANAME."vtcal_category c, ".SCHEMANAME."vtcal_sponsor s WHERE e.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND c.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND s.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND e.categoryid=c.id AND e.sponsorid=s.id AND e.id='".sqlescape($eventid)."'";
	if (is_string($result =& DBQuery($query))) { DBErrorBox("Error retrieving record from ".SCHEMANAME."vtcal_event" . $result); exit; }
	$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	
	disassemble_timestamp($event);

	if (!empty($event['repeatid'])) {
		readinrepeat($event['repeatid'],$event,$repeat);
		echo lang('recurring_event'),": ";
		$repeatdef = repeatinput2repeatdef($event,$repeat);
		printrecurrence($event['timebegin_year'],
			$event['timebegin_month'],
			$event['timebegin_day'],
			$repeatdef);
		echo "<br>";
	}
?>
<br>
<form method="post" action="approval.php">
	<?php echo lang('reason_for_rejection'); ?>
	<br>
	<textarea name="rejectreason" rows="2" cols="50" wrap=virtual></textarea>
	<input type="hidden" name="eventid" value="<?php echo $eventid; ?>">
	<br>
<?php
	if (!empty($event['repeatid']) && num_unapprovedevents($event['repeatid']) > 1) {
		echo '<input type="submit" name="rejectconfirmedall" value="&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;">';
	} 
	else {
		echo '<input type="submit" name="rejectconfirmedthis" value="&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;">';
	} 
?>
	<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
</form>
<br>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>
