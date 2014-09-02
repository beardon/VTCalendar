<?php
require_once('application.inc.php');

/* ==========================================================
     Get the data passed via the query string and form
========================================================== */

if (isset($_POST['choosetemplate'])) { setVar($choosetemplate, $_POST['choosetemplate'],'choosetemplate'); } else { unset($choosetemplate); }
if (isset($_POST['preview'])) { setVar($preview, $_POST['preview'],'preview'); } else { unset($preview); }
if (isset($_POST['savethis'])) { setVar($savethis, $_POST['savethis'],'savethis'); } else { unset($savethis); }
if (isset($_POST['edit'])) { setVar($edit, $_POST['edit'],'edit'); } else { unset($edit); }
if (isset($_POST['eventid'])) { setVar($eventid, $_POST['eventid'],'eventid'); }
else { 
	if (isset($_GET['eventid'])) { setVar($eventid, $_GET['eventid'],'eventid'); } 
	else {
		unset($eventid); 
	}
}
if (isset($_POST['cancel'])) { setVar($cancel, $_POST['cancel'],'cancel'); } else { unset($cancel); }

// If the event is a copy of the passed eventid. '1' is true. Any other value is false.
if (isset($_POST['copy'])) { setVar($copy, $_POST['copy'],'copy'); } 
elseif (isset($_GET['copy'])) { setVar($copy, $_GET['copy'],'copy'); } 
else { $copy = 0; }

if (isset($_POST['check'])) { setVar($check, $_POST['check'],'check'); } else { unset($check); }
if (isset($_POST['templateid'])) { setVar($templateid, $_POST['templateid'],'templateid'); } else { unset($templateid); }
if (isset($_POST['httpreferer'])) { setVar($httpreferer, $_POST['httpreferer'],'httpreferer'); } else { unset($httpreferer); }
if (isset($_GET['timebegin_year'])) { setVar($timebegin_year, $_GET['timebegin_year'],'timebegin_year'); } else { unset($timebegin_year); }
if (isset($_GET['timebegin_month'])) { setVar($timebegin_month, $_GET['timebegin_month'],'timebegin_month'); } else { unset($timebegin_month); }
if (isset($_GET['timebegin_day'])) { setVar($timebegin_day, $_GET['timebegin_day'],'timebegin_day'); } else { unset($timebegin_day); }
if (isset($_POST['repeat'])) {
	if (isset($_POST['repeat']['mode'])) { setVar($repeat['mode'], $_POST['repeat']['mode'],'mode'); } else { unset($repeat['mode']); }
	if (isset($_POST['repeat']['interval1'])) { setVar($repeat['interval1'], $_POST['repeat']['interval1'],'interval1'); } else { unset($repeat['interval1']); }
	if (isset($_POST['repeat']['interval2'])) { setVar($repeat['interval2'], $_POST['repeat']['interval2'],'interval2'); } else { unset($repeat['interval2']); }
	if (isset($_POST['repeat']['frequency1'])) { setVar($repeat['frequency1'], $_POST['repeat']['frequency1'],'frequency1'); } else { unset($repeat['frequency1']); }
	if (isset($_POST['repeat']['frequency2modifier1'])) { setVar($repeat['frequency2modifier1'], $_POST['repeat']['frequency2modifier1'],'frequency2modifier1'); } else { unset($repeat['frequency2modifier1']); }
	if (isset($_POST['repeat']['frequency2modifier2'])) { setVar($repeat['frequency2modifier2'], $_POST['repeat']['frequency2modifier2'],'frequency2modifier2'); } else { unset($repeat['frequency2modifier2']); }
}
else {
	unset($repeat);
}

// The data about the event.
if (isset($_POST['event'])) {
	if (isset($_POST['event']['timebegin_year'])) { setVar($event['timebegin_year'],$_POST['event']['timebegin_year'],'timebegin_year'); } else { unset($event['timebegin_year']); }
	if (isset($_POST['event']['timebegin_month'])) { setVar($event['timebegin_month'],$_POST['event']['timebegin_month'],'timebegin_month'); } else { unset($event['timebegin_month']); }
	if (isset($_POST['event']['timebegin_day'])) { setVar($event['timebegin_day'],$_POST['event']['timebegin_day'],'timebegin_day'); } else { unset($event['timebegin_day']); }
	if (isset($_POST['event']['timebegin_hour'])) { setVar($event['timebegin_hour'],$_POST['event']['timebegin_hour'],'timebegin_hour'); } else { unset($event['timebegin_hour']); }
	if (isset($_POST['event']['timebegin_min'])) { setVar($event['timebegin_min'],$_POST['event']['timebegin_min'],'timebegin_min'); } else { unset($event['timebegin_min']); }
	if (isset($_POST['event']['timebegin_ampm'])) { setVar($event['timebegin_ampm'],$_POST['event']['timebegin_ampm'],'timebegin_ampm'); } else { unset($event['timebegin_ampm']); }
	if (isset($_POST['event']['timeend_year'])) { setVar($event['timeend_year'],$_POST['event']['timeend_year'],'timeend_year'); } else { unset($event['timeend_year']); }
	if (isset($_POST['event']['timeend_month'])) { setVar($event['timeend_month'],$_POST['event']['timeend_month'],'timeend_month'); } else { unset($event['timeend_month']); }
	if (isset($_POST['event']['timeend_day'])) { setVar($event['timeend_day'],$_POST['event']['timeend_day'],'timeend_day'); } else { unset($event['timeend_day']); }
	if (isset($_POST['event']['timeend_hour'])) { setVar($event['timeend_hour'],$_POST['event']['timeend_hour'],'timeend_hour'); } else { unset($event['timeend_hour']); }
	if (isset($_POST['event']['timeend_min'])) { setVar($event['timeend_min'],$_POST['event']['timeend_min'],'timeend_min'); } else { unset($event['timeend_min']); }
	if (isset($_POST['event']['timeend_ampm'])) { setVar($event['timeend_ampm'],$_POST['event']['timeend_ampm'],'timeend_ampm'); } else { unset($event['timeend_ampm']); }
	if (isset($_POST['event']['wholedayevent'])) { setVar($event['wholedayevent'],$_POST['event']['wholedayevent'],'wholedayevent'); } else { unset($event['wholedayevent']); }
	if (isset($_POST['event']['categoryid'])) { setVar($event['categoryid'],$_POST['event']['categoryid'],'categoryid'); } else { unset($event['categoryid']); }
	if (isset($_POST['event']['title'])) { setVar($event['title'],$_POST['event']['title'],'title'); } else { unset($event['title']); }
	if (isset($_POST['event']['location'])) { setVar($event['location'],$_POST['event']['location'],'location'); } else { unset($event['location']); }
	if (isset($_POST['event']['price'])) { setVar($event['price'],$_POST['event']['price'],'price'); } else { unset($event['price']); }
	if (isset($_POST['event']['description'])) { setVar($event['description'],$_POST['event']['description'],'description'); } else { unset($event['description']); }
	if (isset($_POST['event']['url'])) { setVar($event['url'],$_POST['event']['url'],'url'); } else { unset($event['url']); }
	if (isset($_POST['event']['sponsorid'])) { setVar($event['sponsorid'],$_POST['event']['sponsorid'],'sponsorid'); } else { unset($event['sponsorid']); }
	if (isset($_POST['event']['displayedsponsor'])) { setVar($event['displayedsponsor'],$_POST['event']['displayedsponsor'],'displayedsponsor'); } else { unset($event['displayedsponsor']); }
	if (isset($_POST['event']['displayedsponsorurl'])) { setVar($event['displayedsponsorurl'],$_POST['event']['displayedsponsorurl'],'url'); } else { unset($event['displayedsponsorurl']); }
	if (isset($_POST['event']['showincategory'])) { setVar($event['showincategory'],$_POST['event']['showincategory'],'categoryid'); } else { unset($event['showincategory']); }
	if (isset($_POST['event']['showondefaultcal'])) { setVar($event['showondefaultcal'],$_POST['event']['showondefaultcal'],'showondefaultcal'); } else { unset($event['showondefaultcal']); }
	if (isset($_POST['event']['contact_name'])) { setVar($event['contact_name'],$_POST['event']['contact_name'],'contact_name'); } else { unset($event['contact_name']); }
	if (isset($_POST['event']['contact_phone'])) { setVar($event['contact_phone'],$_POST['event']['contact_phone'],'contact_phone'); } else { unset($event['contact_phone']); }
	if (isset($_POST['event']['contact_email'])) { setVar($event['contact_email'],$_POST['event']['contact_email'],'contact_email'); } else { unset($event['contact_email']); }
	if (isset($_POST['event']['repeatid'])) { setVar($event['repeatid'],$_POST['event']['repeatid'],'repeatid'); } else { unset($event['repeatid']); }
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
	$query = "SELECT sponsorid FROM vtcal_event WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'";
	$result = DBQuery($query );
	
	// Check that the record exists in "vtcal_event".
	if ($result->numRows() > 0) {
			$e = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	}
	
	// If it doesn't, check that it exists in "vtcal_event_public"
	else {
		$query = "SELECT * FROM vtcal_event_public WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'";
		$result = DBQuery($query ); 
		
		// If the event exists in "event_public", then insert it into "event" since it is missing...
		if ($result->numRows() > 0) {
			$e = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
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
	echo '<INPUT type="hidden" name="event[timebegin_year]" value="',HTMLSpecialChars($event['timebegin_year']),"\">\n";
	echo '<INPUT type="hidden" name="event[timebegin_month]" value="',HTMLSpecialChars($event['timebegin_month']),"\">\n";
	echo '<INPUT type="hidden" name="event[timebegin_day]" value="',HTMLSpecialChars($event['timebegin_day']),"\">\n";
	echo '<INPUT type="hidden" name="event[timebegin_hour]" value="',HTMLSpecialChars($event['timebegin_hour']),"\">\n";
	echo '<INPUT type="hidden" name="event[timebegin_min]" value="',HTMLSpecialChars($event['timebegin_min']),"\">\n";
	echo '<INPUT type="hidden" name="event[timebegin_ampm]" value="',HTMLSpecialChars($event['timebegin_ampm']),"\">\n";
	echo '<INPUT type="hidden" name="event[timeend_year]" value="',HTMLSpecialChars($event['timeend_year']),"\">\n";
	echo '<INPUT type="hidden" name="event[timeend_month]" value="',HTMLSpecialChars($event['timeend_month']),"\">\n";
	echo '<INPUT type="hidden" name="event[timeend_day]" value="',HTMLSpecialChars($event['timeend_day']),"\">\n";
	echo '<INPUT type="hidden" name="event[timeend_hour]" value="',HTMLSpecialChars($event['timeend_hour']),"\">\n";
	echo '<INPUT type="hidden" name="event[timeend_min]" value="',HTMLSpecialChars($event['timeend_min']),"\">\n";
	echo '<INPUT type="hidden" name="event[timeend_ampm]" value="',HTMLSpecialChars($event['timeend_ampm']),"\">\n";
	if (!empty($event['repeatid'])) {
		echo '<INPUT type="hidden" name="event[repeatid]" value="',$event['repeatid'],"\">\n";
	}
	echo '<INPUT type="hidden" name="repeat[mode]" value="',HTMLSpecialChars($repeat['mode']),'">',"\n";
	if (!empty($repeat['interval1'])) { echo '<INPUT type="hidden" name="repeat[interval1]" value="',$repeat['interval1'],'">',"\n"; }
 	if (!empty($repeat['frequency1'])) { echo '<INPUT type="hidden" name="repeat[frequency1]" value="',$repeat['frequency1'],'">',"\n"; }
	if (!empty($repeat['interval2'])) { echo '<INPUT type="hidden" name="repeat[interval2]" value="',$repeat['interval2'],'">',"\n"; }
	if (!empty($repeat['frequency2modifier1'])) { echo '<INPUT type="hidden" name="repeat[frequency2modifier1]" value="',$repeat['frequency2modifier1'],'">',"\n"; }
	if (!empty($repeat['frequency2modifier2'])) { echo '<INPUT type="hidden" name="repeat[frequency2modifier2]" value="',$repeat['frequency2modifier2'],'">',"\n"; }
}

function passeventvalues($event,$sponsorid,$repeat) {
	// pass the values
//  echo '<INPUT type="hidden" name="event[rejectreason]" value="',HTMLSpecialChars($event['rejectreason']),"\">\n";
	passeventtimevalues($event,$repeat);
	echo '<INPUT type="hidden" name="event[sponsorid]" value="',HTMLSpecialChars($event['sponsorid']),"\">\n";
	echo '<INPUT type="hidden" name="event[title]" value="',HTMLSpecialChars($event['title']),"\">\n";
	echo '<INPUT type="hidden" name="event[wholedayevent]" value="',HTMLSpecialChars($event['wholedayevent']),"\">\n";
	echo '<INPUT type="hidden" name="event[categoryid]" value="',HTMLSpecialChars($event['categoryid']),"\">\n";
	echo '<INPUT type="hidden" name="event[description]" value="',HTMLSpecialChars($event['description']),"\">\n";
	echo '<INPUT type="hidden" name="event[location]" value="',HTMLSpecialChars($event['location']),"\">\n";
	echo '<INPUT type="hidden" name="event[price]" value="',HTMLSpecialChars($event['price']),"\">\n";
	echo '<INPUT type="hidden" name="event[contact_name]" value="',HTMLSpecialChars($event['contact_name']),"\">\n";
	echo '<INPUT type="hidden" name="event[contact_phone]" value="',HTMLSpecialChars($event['contact_phone']),"\">\n";
	echo '<INPUT type="hidden" name="event[contact_email]" value="',HTMLSpecialChars($event['contact_email']),"\">\n";
	echo '<INPUT type="hidden" name="event[url]" value="',HTMLSpecialChars($event['url']),"\">\n";
	echo '<INPUT type="hidden" name="event[displayedsponsor]" value="',HTMLSpecialChars($event['displayedsponsor']),"\">\n";
	echo '<INPUT type="hidden" name="event[displayedsponsorurl]" value="',HTMLSpecialChars($event['displayedsponsorurl']),"\">\n";
	echo '<INPUT type="hidden" name="event[showondefaultcal]" value="',HTMLSpecialChars($event['showondefaultcal']),"\">\n";
	echo '<INPUT type="hidden" name="event[showincategory]" value="',HTMLSpecialChars($event['showincategory']),"\">\n";
} // end: function passeventvalues
?>