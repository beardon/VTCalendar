<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

// Output an error message if $result is a string.
if (is_string($result)) {
	DBErrorBox($result);
}

// Otherwise, the query was successful.
else {
	// read first event if one exists
	if ($result->numRows()>0) {
		$event['calendarid'] = $_SESSION['CALENDAR_ID'];
		$event['id'] = $eventid;
		
		if ((isset($_SESSION["AUTH_SPONSORID"]) && $_SESSION["AUTH_SPONSORID"]==$event['sponsorid']) || !empty($_SESSION['AUTH_ISCALENDARADMIN'])) {
			?><div style="padding: 5px;" class="NoPrint"><?php adminButtons($event, array('update','copy','delete'), "normal", "horizontal"); ?></div><?php
		}
		print_event($event);    
	}
}
?>