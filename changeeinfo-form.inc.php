<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

// ================================
// Display input form
// ================================

if (isset($eventid)) {
	if (isset($copy) && $copy == 1) {
		pageheader(lang('copy_event'), "Update");
		echo "<INPUT type=\"hidden\" name=\"copy\" value=\"",$copy,"\">\n";
	} else {
		pageheader(lang('update_event'), "Update");
	}
}
else {
	pageheader(lang('add_new_event'), "Update");
}

// Preset event with defaults if the form has not yet been submitted.
if (!isset($check)) {
	defaultevent($event,$_SESSION["AUTH_SPONSORID"]);
}

// Load template if necessary
if (isset($templateid)) {
	if ($templateid > 0) {
		$result = DBQuery("SELECT * FROM vtcal_template WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($templateid)."'" ); 
		$event = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	}
}

// "add new event" was started from week,month or detail view.
if (isset($timebegin_year)) { $event['timebegin_year']=$timebegin_year; }
if (isset($timebegin_month)) { $event['timebegin_month']=$timebegin_month; }
if (isset($timebegin_day)) { $event['timebegin_day']=$timebegin_day; }

// Load event to update information if it's the first time the form is viewed.
if (isset($eventid) && (!isset($check) || $check != 1)) {
	$result = DBQuery("SELECT * FROM vtcal_event WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'" ); 
	
	// Event exists in vtcal_event.
	if ($result->numRows() > 0) {
		$event = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	}
	// For some reason the event is not in vtcal_event (even though it should be).
	// Try to load it from "event_public".
	else {
		$result = DBQuery("SELECT * FROM vtcal_event_public WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'" ); 

		// Event exists in "event_public".
		// Insert into vtcal_event since it is missing.
		if ($result->numRows() > 0) {
			$event = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
			//eventaddslashes($event);
			insertintoevent($event['id'],$event);
		}
	}

	disassemble_timestamp($event);
	if (!empty($event['repeatid'])) {
		readinrepeat($event['repeatid'],$event,$repeat);
	}
	else { $repeat['mode'] = 0; }
	//$sponsorid = $event[sponsorid];
}

contentsection_begin(lang('input_event_information'));

echo "<form name=\"inputevent\" method=\"post\" action=\"changeeinfo.php\">\n";
inputeventbuttons($httpreferer);

if (!isset($check)) { $check = 0; }
inputeventdata($event,$event['sponsorid'],1,$check,1,$repeat,$copy);
echo '<INPUT type="hidden" name="httpreferer" value="',$httpreferer,'">',"\n";
if (isset($eventid)) { echo "<INPUT type=\"hidden\" name=\"eventid\" value=\"",$event['id'],"\">\n"; }
echo '<INPUT type="hidden" name="event[repeatid]" value="', isset($event['repeatid']) ? HTMLSpecialChars($event['repeatid']) : "" ,"\">\n";
if (!$_SESSION['AUTH_ISCALENDARADMIN']) { echo "<INPUT type=\"hidden\" name=\"event[sponsorid]\" value=\"",$event['sponsorid'],"\">\n"; }
if (isset($copy)) { echo "<INPUT type=\"hidden\" name=\"copy\" value=\"",$copy,"\">\n"; }

inputeventbuttons($httpreferer);
echo "</form>\n";

contentsection_end();

function inputeventbuttons($httpreferer) {
	?>
	<p><INPUT type="submit" name="preview" value="<?php echo lang('preview_event'); ?>">
	<INPUT type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>"  onclick="location.href = '<?php echo $httpreferer; ?>'; return false;"></p>
	<?php
}
?>