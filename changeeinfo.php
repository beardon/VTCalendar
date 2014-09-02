<?php
require_once('application.inc.php');

/* ==========================================================
     Get the data passed via the query string and form
========================================================== */

if (!isset($_POST['choosetemplate']) || !setVar($choosetemplate, $_POST['choosetemplate'],'choosetemplate')) unset($choosetemplate);
if (!isset($_POST['preview']) || !setVar($preview, $_POST['preview'],'preview')) unset($preview);
if (!isset($_POST['savethis']) || !setVar($savethis, $_POST['savethis'],'savethis')) unset($savethis);
if (!isset($_POST['edit']) || !setVar($edit, $_POST['edit'],'edit')) unset($edit);
if (!isset($_POST['eventid']) || !setVar($eventid, $_POST['eventid'],'eventid')) { 
	if (!isset($_GET['eventid']) || !setVar($eventid, $_GET['eventid'],'eventid')) unset($eventid);
}
if (!isset($_POST['cancel']) || !setVar($cancel, $_POST['cancel'],'cancel')) unset($cancel);

// If the event is a copy of the passed eventid. '1' is true. Any other value is false.
if (!isset($_POST['copy']) || !setVar($copy, $_POST['copy'],'copy')) {
	if (!isset($_GET['copy']) || !setVar($copy, $_GET['copy'],'copy')) { $copy = 0; }
}

if (!isset($_POST['check']) || !setVar($check, $_POST['check'],'check')) unset($check);
if (!isset($_POST['templateid']) || !setVar($templateid, $_POST['templateid'],'templateid')) unset($templateid);
if (!isset($_POST['httpreferer']) || !setVar($httpreferer, $_POST['httpreferer'],'httpreferer')) unset($httpreferer);
if (!isset($_GET['timebegin_year']) || !setVar($timebegin_year, $_GET['timebegin_year'],'timebegin_year')) unset($timebegin_year);
if (!isset($_GET['timebegin_month']) || !setVar($timebegin_month, $_GET['timebegin_month'],'timebegin_month')) unset($timebegin_month);
if (!isset($_GET['timebegin_day']) || !setVar($timebegin_day, $_GET['timebegin_day'],'timebegin_day')) unset($timebegin_day);
if (isset($_POST['repeat'])) {
	if (!isset($_POST['repeat']['mode']) || !setVar($repeat['mode'], $_POST['repeat']['mode'],'mode')) unset($repeat['mode']);
	if (!isset($_POST['repeat']['interval1']) || !setVar($repeat['interval1'], $_POST['repeat']['interval1'],'interval1')) unset($repeat['interval1']);
	if (!isset($_POST['repeat']['interval2']) || !setVar($repeat['interval2'], $_POST['repeat']['interval2'],'interval2')) unset($repeat['interval2']);
	if (!isset($_POST['repeat']['frequency1']) || !setVar($repeat['frequency1'], $_POST['repeat']['frequency1'],'frequency1')) unset($repeat['frequency1']);
	if (!isset($_POST['repeat']['frequency2modifier1']) || !setVar($repeat['frequency2modifier1'], $_POST['repeat']['frequency2modifier1'],'frequency2modifier1')) unset($repeat['frequency2modifier1']);
	if (!isset($_POST['repeat']['frequency2modifier2']) || !setVar($repeat['frequency2modifier2'], $_POST['repeat']['frequency2modifier2'],'frequency2modifier2')) unset($repeat['frequency2modifier2']);
}
else {
	unset($repeat);
}

// The data about the event.
if (isset($_POST['event'])) {
	if (!isset($_POST['event']['timebegin_year']) || !setVar($event['timebegin_year'],$_POST['event']['timebegin_year'],'timebegin_year')) unset($event['timebegin_year']);
	if (!isset($_POST['event']['timebegin_month']) || !setVar($event['timebegin_month'],$_POST['event']['timebegin_month'],'timebegin_month')) unset($event['timebegin_month']);
	if (!isset($_POST['event']['timebegin_day']) || !setVar($event['timebegin_day'],$_POST['event']['timebegin_day'],'timebegin_day')) unset($event['timebegin_day']);
	if (!isset($_POST['event']['timebegin_hour']) || !setVar($event['timebegin_hour'],$_POST['event']['timebegin_hour'],'timebegin_hour')) unset($event['timebegin_hour']);
	if (!isset($_POST['event']['timebegin_min']) || !setVar($event['timebegin_min'],$_POST['event']['timebegin_min'],'timebegin_min')) unset($event['timebegin_min']);
	if (!isset($_POST['event']['timebegin_ampm']) || !setVar($event['timebegin_ampm'],$_POST['event']['timebegin_ampm'],'timebegin_ampm')) unset($event['timebegin_ampm']);
	if (!isset($_POST['event']['timeend_year']) || !setVar($event['timeend_year'],$_POST['event']['timeend_year'],'timeend_year')) unset($event['timeend_year']);
	if (!isset($_POST['event']['timeend_month']) || !setVar($event['timeend_month'],$_POST['event']['timeend_month'],'timeend_month')) unset($event['timeend_month']);
	if (!isset($_POST['event']['timeend_day']) || !setVar($event['timeend_day'],$_POST['event']['timeend_day'],'timeend_day')) unset($event['timeend_day']);
	if (!isset($_POST['event']['timeend_hour']) || !setVar($event['timeend_hour'],$_POST['event']['timeend_hour'],'timeend_hour')) unset($event['timeend_hour']);
	if (!isset($_POST['event']['timeend_min']) || !setVar($event['timeend_min'],$_POST['event']['timeend_min'],'timeend_min')) unset($event['timeend_min']);
	if (!isset($_POST['event']['timeend_ampm']) || !setVar($event['timeend_ampm'],$_POST['event']['timeend_ampm'],'timeend_ampm')) unset($event['timeend_ampm']);
	if (!isset($_POST['event']['wholedayevent']) || !setVar($event['wholedayevent'],$_POST['event']['wholedayevent'],'wholedayevent')) unset($event['wholedayevent']);
	if (!isset($_POST['event']['categoryid']) || !setVar($event['categoryid'],$_POST['event']['categoryid'],'categoryid')) unset($event['categoryid']);
	if (!isset($_POST['event']['title']) || !setVar($event['title'],$_POST['event']['title'],'title')) unset($event['title']);
	if (!isset($_POST['event']['location']) || !setVar($event['location'],$_POST['event']['location'],'location')) unset($event['location']);
	if (!isset($_POST['event']['price']) || !setVar($event['price'],$_POST['event']['price'],'price')) unset($event['price']);
	if (!isset($_POST['event']['description']) || !setVar($event['description'],$_POST['event']['description'],'description')) unset($event['description']);
	if (!isset($_POST['event']['sponsorid']) || !setVar($event['sponsorid'],$_POST['event']['sponsorid'],'sponsorid')) unset($event['sponsorid']);
	if (!isset($_POST['event']['displayedsponsor']) || !setVar($event['displayedsponsor'],$_POST['event']['displayedsponsor'],'displayedsponsor')) unset($event['displayedsponsor']);
	if (!isset($_POST['event']['displayedsponsorurl']) || !setVar($event['displayedsponsorurl'],$_POST['event']['displayedsponsorurl'],'url')) unset($event['displayedsponsorurl']);
	if (!isset($_POST['event']['showincategory']) || !setVar($event['showincategory'],$_POST['event']['showincategory'],'categoryid')) unset($event['showincategory']);
	if (!isset($_POST['event']['showondefaultcal']) || !setVar($event['showondefaultcal'],$_POST['event']['showondefaultcal'],'showondefaultcal')) unset($event['showondefaultcal']);
	if (!isset($_POST['event']['contact_name']) || !setVar($event['contact_name'],$_POST['event']['contact_name'],'contact_name')) unset($event['contact_name']);
	if (!isset($_POST['event']['contact_phone']) || !setVar($event['contact_phone'],$_POST['event']['contact_phone'],'contact_phone')) unset($event['contact_phone']);
	if (!isset($_POST['event']['contact_email']) || !setVar($event['contact_email'],$_POST['event']['contact_email'],'contact_email')) unset($event['contact_email']);
	if (!isset($_POST['event']['repeatid']) || !setVar($event['repeatid'],$_POST['event']['repeatid'],'repeatid')) unset($event['repeatid']);
	if (isset($_POST['event']['defaultallsponsor'])) { $event['defaultallsponsor'] = true; } else { unset($event['defaultallsponsor']); }
	if (isset($_POST['event']['defaultdisplayedsponsor'])) { $event['defaultdisplayedsponsor'] = true; } else { unset($event['defaultdisplayedsponsor']); }
	if (isset($_POST['event']['defaultdisplayedsponsorurl'])) { $event['defaultdisplayedsponsorurl'] = true; } else { unset($event['defaultdisplayedsponsorurl']); }
}
else {
	unset($event);	
}

// Check that the user is authorized.
if (!authorized()) { exit; }

// Set up where the user will be redirected if canceling or after submitting the event.
if (!isset($httpreferer)) {
	if (empty($_SERVER["HTTP_REFERER"])) {
		$httpreferer = "update.php";
	}
	else {
		$httpreferer = $_SERVER["HTTP_REFERER"];
	}
}

// Redirect the user back if cancel was pressed.
if (isset($cancel)) {
	redirect2URL($httpreferer);
	exit;
};

// Check that the event ID is valid, if one was passed.
if (!empty($eventid)) {
	$query = "SELECT sponsorid FROM ".SCHEMANAME."vtcal_event WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'";
	if (is_string($result =& DBQuery($query))) { DBErrorBox("Error retrieving record from ".SCHEMANAME."vtcal_event" . $result); exit; }
	
	// Check that the record exists in "vtcal_event".
	if ($result->numRows() > 0) {
			$e =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	}
	
	// If it doesn't, check that it exists in "vtcal_event_public"
	else {
		$query = "SELECT * FROM ".SCHEMANAME."vtcal_event_public WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'";
		if (is_string($result =& DBQuery($query))) { DBErrorBox("Error retrieving record from ".SCHEMANAME."vtcal_event_public" . $result); exit; }
		
		
		// If the event exists in "event_public", then insert it into "event" since it is missing...
		if ($result->numRows() > 0) {
			$e =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
			insertintoevent($e['id'],$e);
		}
		
		// Otherwise, the event does not exist at all.
		else {
			redirect2URL($httpreferer);
			exit;
		}
	}
	
	// If the user is not the admin and not the sponsor, then redirect them away from this page.
	if (empty($_SESSION['AUTH_ISCALENDARADMIN']) && (!isset($_SESSION["AUTH_SPONSORID"]) || $_SESSION["AUTH_SPONSORID"] != $e['sponsorid'])) {
			 redirect2URL($httpreferer);
			 exit;
	}
}

// Include the eventid with the submitted event data.
if (isset($eventid)) { $event['id'] = $eventid; }

// Check if the event data is valid.
$eventvalid = checkevent($event, $repeat);

// Override the passed sponsorid with the user's sponsor ID to avoid potential tampering with the values.
if (empty($event['sponsorid'])) {
	$event['sponsorid']=$_SESSION["AUTH_SPONSORID"];
}

// If the event is not repeating, make sure the end date is the same as the begin date.
if ($repeat['mode'] == "0") {
	$event['timeend_year']=$event['timebegin_year'];
	$event['timeend_month']=$event['timebegin_month'];
	$event['timeend_day']=$event['timebegin_day'];
}

// Otherwise, set up the repeating data.
if ($repeat['mode'] > 0 && !empty($repeat['interval1'])) {
	$repeat['repeatdef'] = repeatinput2repeatdef($event,$repeat);
}

// if event is a "whole day event" than set time to 12am
if (isset($event['wholedayevent']) && $event['wholedayevent']==1) {
	$event['timebegin_hour']=12;
	$event['timebegin_min']=0;
	$event['timebegin_ampm']="am";
	$event['timeend_hour']=11;
	$event['timeend_min']=59;
	$event['timeend_ampm']="pm";
}

// Reset the sponsor name/URL if the buttons were pressed.
if (isset($event['defaultdisplayedsponsor']) || isset($event['defaultallsponsor'])) {
	$event['displayedsponsor']=getSponsorName($event['sponsorid']);
}
if (isset($event['defaultdisplayedsponsorurl']) || isset($event['defaultallsponsor'])) {
	$event['displayedsponsorurl']=getSponsorURL($event['sponsorid']);
}

// Save event into DB (if it is valid).
if (isset($savethis) && $eventvalid) {
	require("changeeinfo-save.inc.php");
}

// Display preview
if (isset($check) && $eventvalid && isset($preview)) {
	require("changeeinfo-preview.inc.php");
}

// Display input form
else {
	require("changeeinfo-form.inc.php");
}

pagefooter();
DBclose();
	
function passeventtimevalues($event,$repeat) {
	$eventFields = explode(' ', 'timebegin_year timebegin_month timebegin_day timebegin_hour timebegin_min timebegin_ampm timeend_year timeend_month timeend_day timeend_hour timeend_min timeend_ampm repeatid');
	foreach ($eventFields as $field) {
		echo '<input type="hidden" name="event['.$field.']" value="';
		if (isset($event[$field])) {
			echo HTMLSpecialChars($event[$field]);
		}
		echo "\">\n";
	}
	
	$repeatFields = explode(' ', 'mode interval1 frequency1 interval2 frequency2modifier1 frequency2modifier2');
	foreach ($repeatFields as $field) {
		echo '<input type="hidden" name="repeat['.$field.']" value="';
		if (isset($repeat[$field])) {
			echo HTMLSpecialChars($repeat[$field]);
		}
		echo "\">\n";
	}
}

function passeventvalues($event,$sponsorid,$repeat) {
	passeventtimevalues($event,$repeat);
	
	$fields = explode(' ', 'sponsorid title wholedayevent categoryid description location price contact_name contact_phone contact_email displayedsponsor displayedsponsorurl showondefaultcal showincategory');
	foreach ($fields as $field) {
		echo '<input type="hidden" name="event['.$field.']" value="';
		if (isset($event[$field])) {
			echo HTMLSpecialChars($event[$field]);
		}
		echo "\">\n";
	}
} // end: function passeventvalues
?>