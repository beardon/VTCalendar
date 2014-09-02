<?php
// Make sure this script does not take a long time to execute.
set_time_limit(10);
define("DOEXPORT", true);

// Tell application.inc.php not to perform DB actions
define("NOLOADDB", true);

// Validate the user if the export is flagged as being an admin export.
if (isset($_GET['adminexport']) || isset($_POST['adminexport'])) {
	define("IS_ADMIN_EXPORT", true);
	define("HIDELOGIN", true);
	require_once('../application.inc.php');
	
	// Exit if the user is not authenticated or is not a man admin.
	if (!authorized() || !$_SESSION['AUTH_ISCALENDARADMIN']) exit;
}
else {
	define("ALLOWINCLUDES", TRUE); // Allows this file to include other files (e.g. config.inc.php).
	@(include_once('DB.php')) or die('');
	@(include_once('../version.inc.php')); // TODO: Should this fail if the file cannot be loaded?
	@(include_once('../config.inc.php')) or die('');
	require_once('../config-defaults.inc.php');
	
	$FUNCINCLUDE = array_flip(explode(' ', 'dates dates-generic inputvalidation db-generic db-gets export misc'));
	require_once('../functions.inc.php');
	
	require_once('../languages/en.inc.php');
	if (LANGUAGE != 'en') require_once('../languages/'.LANGUAGE.'.inc.php');
	require_once('../constants.inc.php');
}

require_once('export-functions.inc.php');
require_once('../main_export_data.inc.php');

if (count($FormErrors) > 0) {
	outputErrorMessage("- " . html_entity_decode(implode("\n\n- ", $FormErrors)));
}

// ==========================================================
// Get the calendar ID from the query string
// ==========================================================

// If the query string is passing a valid CalendarID, set it to a variable.
if ( isset($_GET['calendarid']) && isValidInput($_GET['calendarid'],'calendarid') )
	{ $CalendarID = $_GET['calendarid']; }
elseif ( isset($_GET['calendar']) && isValidInput($_GET['calendar'],'calendarid') ) 
	{ $CalendarID = $_GET['calendar']; }

// Otherwise, the CalendarID is missing or invalid
else { outputErrorMessage("The CalendarID was not specified or is invalid."); }

// ==========================================================
// Load the Calendar Information
// ==========================================================

$DBCONNECTION =& DBOpen();
if (is_string($DBCONNECTION)) {
	outputErrorMessage("A database error occurred: " . $DBCONNECTION);
}

$calendardata =& getCalendarData($CalendarID);

// If there was an error, output the reason.
if (is_string($calendardata)) {
	outputErrorMessage("A database error occurred: " . $calendardata);
}

// If a number was returned, then the calendar does not exist or somehow too many records returned.
elseif (is_int($calendardata)) {
	if ($calendardata == 0) {
		outputErrorMessage("The '".$CalendarID."' calendar does not exist.");
	} else {
		outputErrorMessage("Too many records returned when attempting to retrieve the calendar information (".$calendardata.").");
	}
}

// If the calendar requires authentication to view, then exit.
elseif ($calendardata['viewauthrequired'] > 0) {
	outputErrorMessage("The '".$CalendarID."' calendar requires authentication to be viewed, so it cannot be used by the export script.");
}

// ==========================================================
// Get the events from the database.
// ==========================================================

$query = BuildExportQuery($CalendarID, $FormData);

// Execute the query, and output an error message if one was caught.
if (is_string( $result =& DBQuery($query) ) ) {
	outputErrorMessage("A database error occurred: ". $result);
}

// ==========================================================
// Set headers to allow caching.
// ==========================================================

// Set the expiration of the returned data.
Header("Expires: " . gmdate("D, d M Y H:i:s", time() + (EXPORT_CACHE_MINUTES*60)) . " GMT");

// Set that this file was last updated right now.
Header("Last-Modified: " . gmdate("D, d M Y H:i:s", time()) . " GMT");

if (isset($_GET['raw'])) Header("Content-Type: text/plain");

switch($FormData['format']) {
	case "rss":
		if (!isset($_GET['raw'])) Header("Content-Type: text/xml");
		echo GenerateRSS($result, $CalendarID, $calendardata['name'] .": ".$calendardata['title'], BASEURL);
		break;
	case "rss1_0":
		if (!isset($_GET['raw'])) Header("Content-Type: text/xml");
		echo GenerateRSS1_0($result, $CalendarID, $calendardata['name'] .": ".$calendardata['title'], BASEURL);
		break;
	case "rss2_0":
		if (!isset($_GET['raw'])) Header("Content-Type: text/xml");
		echo GenerateRSS2_0($result, $CalendarID, $calendardata['name'] .": ".$calendardata['title'], BASEURL, BASEURL.EXPORT_PATH.'?'.http_build_query($_GET));
		break;
	case "xml":
		if (!isset($_GET['raw'])) Header("Content-Type: text/xml");
		echo GenerateXML($result, $CalendarID, $calendardata['name'] .": ".$calendardata['title'], BASEURL);
		break;
	case "ical":
		if (!isset($_GET['raw'])) Header("Content-Type: text/calendar; charset=\"utf-8\"; name=\"export.ics\"");
		if (!isset($_GET['raw'])) Header("Content-disposition: attachment; filename=export.ics");
		echo GenerateICal($result, $calendardata['name']);
		break;
	case "vxml":
		if (!isset($_GET['raw'])) Header("Content-Type: text/xml");
		echo GenerateVXML($result);
		break;
	case "html":
		if (!isset($_GET['raw'])) Header("Content-Type: text/html");
		echo GenerateHTML($result, $CalendarID, BASEURL, $FormData);
		break;
	case "js":
		if (!isset($_GET['raw'])) Header("Content-Type: application/x-javascript");
		echo GenerateJSArray($result, $CalendarID, BASEURL);
		break;
	default:
		echo "Format not supported";
}
?>