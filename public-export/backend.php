<?php
// Make sure this script does not take a long time to execute.
set_time_limit(10);

define("ALLOWINCLUDES", TRUE); // Allows this file to include other files (e.g. config.inc.php).
require_once('DB.php');
@(include_once('../config.inc.php')) or die('config.inc.php was not found. See: <a href="../install/">VTCalendar Configuration</a> installer.');
require_once('../config-defaults.inc.php');
require_once('../constants.inc.php');
require_once('../functions.inc.php');
require_once('functions.inc.php');
require_once('defaults_and_constants.inc.php');

// ==========================================================
// Retrieve variables being set in the query string.
// ==========================================================

// If the query string is passing a valid CalendarID, set it to a variable.
if ( isset($_GET['calendarid']) && isValidInput($_GET['calendarid'],'calendarid') )
	{ $config['CalendarID'] = $_GET['calendarid']; }
elseif ( isset($_GET['calendar']) && isValidInput($_GET['calendar'],'calendarid') ) 
	{ $config['CalendarID'] = $_GET['calendar']; }

// Otherwise, the CalendarID is missing or invalid
else { outputErrorMessage("The CalendarID was not specified or is invalid."); }

// Override default values with variables being set in the query string.
// Output an error message if any of the input values is invalid.
if ( isset($_GET['maxevents']) && $_GET['maxevents'] != "" ) { if ( isValidRemoteInput($_GET['maxevents'], 'MAXEVENTS') ) { $config['MaxEvents'] = intval($_GET['maxevents']); } else { outputErrorMessage("The value of 'maxevents' is invalid."); } } //else { unset($config['MaxEvents']); }
if ( isset($_GET['maxtitlecharacters']) && $_GET['maxtitlecharacters'] != "" ) { if ( isValidRemoteInput($_GET['maxtitlecharacters'], 'MAXTITLECHARACTERS') ) { $config['MaxTitleCharacters'] = intval($_GET['maxtitlecharacters']); } else { outputErrorMessage("The value of 'maxtitlecharacters' is invalid."); } } //else { unset($config['MaxTitleCharacters']); }
if ( isset($_GET['maxlocationcharacters']) && $_GET['maxlocationcharacters'] != "" ) { if ( isValidRemoteInput($_GET['maxlocationcharacters'], 'MAXLOCATIONCHARACTERS') ) { $config['MaxLocationCharacters'] = intval($_GET['maxlocationcharacters']); } else { outputErrorMessage("The value of 'maxlocationcharacters' is invalid."); } } //else { unset($config['MaxLocationCharacters']); }
if ( isset($_GET['javascript']) && $_GET['javascript'] != "" ) { if ( isValidRemoteInput($_GET['javascript'], 'JAVASCRIPT') ) { $config['JavaScript'] = substr(strtoupper($_GET['javascript']),0,1); } else { outputErrorMessage("The value of 'javascript' is invalid."); } } //else { unset($config['JavaScript']); }
if ( isset($_GET['datatype']) && $_GET['datatype'] != "" ) { if ( isValidRemoteInput($_GET['datatype'], 'DATATYPE') ) { $config['DataType'] = strtoupper($_GET['datatype']); } else { outputErrorMessage("The value of 'datatype' is invalid."); } } //else { unset($config['DataType']); }
if ( isset($_GET['htmltemplate']) && $_GET['htmltemplate'] != "" ) { if ( isValidRemoteInput($_GET['htmltemplate'], 'HTMLTEMPLATE') ) { $config['HTMLTemplate'] = strtoupper($_GET['htmltemplate']); } else { outputErrorMessage("The value of 'htmltemplate' is invalid."); } } //else { unset($config['HTMLTemplate']); }
if ( isset($_GET['dateformat']) && $_GET['dateformat'] != "" ) { if ( isValidRemoteInput($_GET['dateformat'], 'DATEFORMAT') ) { $config['DateFormat'] = strtoupper($_GET['dateformat']); } else { outputErrorMessage("The value of 'dateformat' is invalid."); } } //else { unset($config['DateFormat']); }
if ( isset($_GET['timedisplay']) && $_GET['timedisplay'] != "" ) { if ( isValidRemoteInput($_GET['timedisplay'], 'TIMEDISPLAY') ) { $config['TimeDisplay'] = strtoupper($_GET['timedisplay']); } else { outputErrorMessage("The value of 'timedisplay' is invalid."); } } //else { unset($config['TimeDisplay']); }
if ( isset($_GET['timeformat']) && $_GET['timeformat'] != "" ) { if ( isValidRemoteInput($_GET['timeformat'], 'TIMEFORMAT') ) { $config['TimeFormat'] = strtoupper($_GET['timeformat']); } else { outputErrorMessage("The value of 'timeformat' is invalid."); } } //else { unset($config['TimeFormat']); }
if ( isset($_GET['durationformat']) && $_GET['durationformat'] != "" ) { if ( isValidRemoteInput($_GET['durationformat'], 'DURATIONFORMAT') ) { $config['DurationFormat'] = strtoupper($_GET['durationformat']); } else { outputErrorMessage("The value of 'durationformat' is invalid."); } } //else { unset($config['DurationFormat']); }
if ( isset($_GET['filterby']) && $_GET['filterby'] != "" ) { if ( isValidRemoteInput($_GET['filterby'], 'FILTERBY') ) { $config['FilterBy'] = $_GET['filterby']; } else { outputErrorMessage("The value of 'filterby' is invalid."); } } //else { unset($config['FilterBy']); }
if ( isset($_GET['linkfilter']) && $_GET['linkfilter'] != "" ) { if ( isValidRemoteInput($_GET['linkfilter'], 'LINKFILTER') ) { $config['LinkFilter'] = $_GET['linkfilter']; } else { outputErrorMessage("The value of 'linkfilter' is invalid."); } } //else { unset($config['LinkFilter']); }
if ( isset($_GET['showdatetime']) && $_GET['showdatetime'] != "" ) { if ( isValidRemoteInput($_GET['showdatetime'], 'SHOWDATETIME') ) { $config['ShowDateTime'] = substr(strtoupper($_GET['showdatetime']),0,1); } else { outputErrorMessage("The value of 'showdatetime' is invalid."); } } //else { unset($config['ShowDateTime']); }
if ( isset($_GET['showlocation']) && $_GET['showlocation'] != "" ) { if ( isValidRemoteInput($_GET['showlocation'], 'SHOWLOCATION') ) { $config['ShowLocation'] = substr(strtoupper($_GET['showlocation']),0,1); } else { outputErrorMessage("The value of 'showlocation' is invalid."); } } //else { unset($config['ShowLocation']); }
if ( isset($_GET['showallday']) && $_GET['showallday'] != "" ) { if ( isValidRemoteInput($_GET['showallday'], 'SHOWALLDAY') ) { $config['ShowAllDay'] = substr(strtoupper($_GET['showallday']),0,1); } else { outputErrorMessage("The value of 'showallday' is invalid."); } } //else { unset($config['ShowAllDay']); }
if ( isset($_GET['combinerepeating']) && $_GET['combinerepeating'] != "" ) { if ( isValidRemoteInput($_GET['combinerepeating'], 'COMBINEREPEATING') ) { $config['CombineRepeating'] = substr(strtoupper($_GET['combinerepeating']),0,1); } else { outputErrorMessage("The value of 'combinerepeating' is invalid."); } } //else { unset($config['CombineRepeating']); }
if ( isset($_GET['htmlencode']) && $_GET['htmlencode'] != "" ) { if ( isValidRemoteInput($_GET['htmlencode'], 'HTMLENCODE') ) { $config['HTMLEncode'] = substr(strtoupper($_GET['htmlencode']),0,1); } else { $errors++; $error[$errors] = "The value of 'HTMLEncode' is invalid."; } } //else { unset($config['HTMLEncode']); }

// ==========================================================
// Load the Calendar Information
// ==========================================================

$DBCONNECTION =& DBOpen();
if (is_string($DBCONNECTION)) {
	outputErrorMessage("A database error occurred: " . $DBCONNECTION);
}

$calendardata = getCalendarData($config['CalendarID']);

// If there was an error, output the reason.
if (is_string($calendardata)) {
	outputErrorMessage("A database error occurred: " . $calendardata);
}
// If a number was returned, then the calendar does not exist or somehow too many records returned.
elseif (is_int($calendardata)) {
	if ($calendardata == 0) {
		outputErrorMessage("The '".$config['CalendarID']."' calendar does not exist.");
	} else {
		outputErrorMessage("Too many records returned when attempting to retrieve the calendar information (".$calendardata.").");
	}
}
// If the calendar requires authentication to view, then exit.
elseif ($calendardata['viewauthrequired'] != 0) {
	outputErrorMessage("The '".$config['CalendarID']."' calendar requires authentication to be viewed, so it cannot be used by the public export script.");
}

// ==========================================================
// Get the events from the database.
// ==========================================================

// Create a date/time string in MySQL's format.
define("constCurrentTick", time());
$CurrentQueryDate = date("Y-m-d H:i:s", constCurrentTick);

/*
SELECT e.calendarid, e.id, e.timebegin, e.timeend, e.title, e.wholedayevent, e.categoryid, e.location, r.startdate, r.enddate, r.repeatdef
FROM vtcal_event_public e LEFT JOIN vtcal_event_repeat r on e.repeatid=r.id AND e.calendarid=r.calendarid
WHERE e.CalendarID='studentactivities'  AND ( e.timebegin > '2006-12-12 00:00:00' OR (e.timebegin <= '2006-12-12 00:00:00' AND e.timeend > '2006-12-12 00:00:00') )

SELECT SUBSTRING_INDEX(id,'-',1) as CutID, min(id) as MinID FROM vtcal_event_public
WHERE CalendarID='default' AND timebegin > '2007-01-10 00:00:00' AND timebegin < '2007-02-01 00:00:00'
GROUP BY CutID
*/

$queryfilter = " e.CalendarID='" . sqlescape($config['CalendarID']) . "'";
$queryfilter = $queryfilter." AND ( e.timebegin > '".sqlescape($CurrentQueryDate)."' OR (e.timebegin <= '".sqlescape($CurrentQueryDate)."' AND e.timeend > '".sqlescape($CurrentQueryDate)."') )";

// If any category filters are set, then add them to the query.
if ( isset($config['FilterBy'])) {
	$queryfilter = $queryfilter." AND ( ";
	
	$Filters = split(",", $config['FilterBy']);
	for ($i = 0; $i < count($Filters); $i++) {
		if ( $i > 0 ) {
			$queryfilter = $queryfilter." OR ";
		}
		$queryfilter = $queryfilter." CategoryID='".sqlescape($Filters[$i])."' ";
	}
	
	$queryfilter = $queryfilter." )";
}

if ($config['CombineRepeating'] == "Y" && $config['DataType'] == "HTML" && $config['HTMLTemplate'] == "PARAGRAPH") {
	$query = "SELECT SUBSTRING_INDEX(e.id,'-',1) as CutID, min(e.id) as MinID FROM vtcal_event_public e";
	$query = $query." WHERE ".$queryfilter;
	$query = $query." GROUP BY CutID";
	
	// Execute the query, and output an error message if one was caught.
	if (is_string( $result = DBQuery($query) ) ) {
		outputErrorMessage("A database error occurred: " . $result);
	}
	
	$query = "SELECT e.calendarid, e.id, e.timebegin, e.timeend, e.title, e.wholedayevent, e.categoryid, e.location, r.startdate, r.enddate, year(r.startdate) as startdate_year, month(r.startdate) as startdate_month, day(r.startdate) as startdate_day, r.repeatdef";
	$query = $query. " FROM vtcal_event_public e LEFT JOIN vtcal_event_repeat r on e.repeatid=r.id AND e.calendarid=r.calendarid";
	$query = $query. " WHERE false";
	
	if ($result->numRows() == 0)
	{
		//
	}
	else {
		$ievent = 0;
		while ($ievent < $result->numRows()) {
			$event = $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
			$query = $query." OR e.id = '".$event['MinID']."'";
			$ievent++;
		}
	}
	
	$query = $query." ORDER BY timebegin, title";
	$query = $query." LIMIT ".$config['MaxEvents'];
}
else {
	$query = "SELECT e.calendarid, e.id, e.timebegin, e.timeend, e.title, e.wholedayevent, e.categoryid, e.location";
	$query = $query." FROM vtcal_event_public e";
	$query = $query." WHERE ".$queryfilter;
	$query = $query." ORDER BY timebegin, title";
	$query = $query." LIMIT ".$config['MaxEvents'];
}

// Execute the query, and output an error message if one was caught.
if (is_string( $result = DBQuery($query) ) ) {
	outputErrorMessage("A database error occurred: ". $result);
}

// ==========================================================
// Set headers to allow caching.
// ==========================================================

// Set the expiration of the returned data.
Header("Expires: " . gmdate("D, d M Y H:i:s", time() + (CACHEMINUTES*60)) . " GMT");

// Set that this file was last updated right now.
Header("Last-Modified: " . gmdate("D, d M Y H:i:s", time()) . " GMT");

// ==========================================================
// Output the data.
// ==========================================================

// If any category are set for the link, then create a query string to be used for URLs
if ( isset($config['LinkFilter'])) {
	$Filters = split(",", $config['LinkFilter']);
	for ($i = 0; $i < count($Filters); $i++) {
		$config['LinkFilterQueryString'] = $config['LinkFilterQueryString']."&categoryfilter%5B%5D=".$Filters[$i];
	}
}

// ==========================================================
// Get the data in the requested format
// and set the correct Content-Type header.
// ==========================================================

if ($config['DataType'] == "XML") {
	Header("Content-type: text/xml; charset=ISO-8859-1");
	$outputdata = createXML($result, $config);
}
elseif ($config['DataType'] == "HTML") {
	Header("Content-type: text/html; charset=ISO-8859-1");
	$outputdata = createHTML($result, $config);
}
elseif ($config['DataType'] == "TEXT") {
	Header("Content-type: text/plain; charset=ISO-8859-1");
	$outputdata = createText($result, $config);
}

// An undocumented feature that allows the "preview output" to work well in instructions.php
if (isset($_GET['plaintext'])) {
	Header("Content-type: text/plain; charset=ISO-8859-1");
}

// ==========================================================
// Output the data.
// ==========================================================

// If JavaScript was requested, format the data using document.write() statements.
if (substr($config['JavaScript'],0,1) == "Y") {
	if (!isset($_GET['plaintext'])) {
		Header("Content-type: application/x-javascript; charset=ISO-8859-1");
	}
	$jsparts = ceil(strlen($outputdata)/200);
	for ($i = 0; $i < $jsparts; $i++) {
		if (substr($config['HTMLEncode'],0,1) == "Y") {
			echo htmlspecialchars("document.write('".escapeJavaScriptString(substr($outputdata,$i*200,200))."');\n");
		}
		else {
			echo "document.write('".escapeJavaScriptString(substr($outputdata,$i*200,200))."');\n";
		}
	}
}

// Otherwise, output the data as-is.
else {
	if (substr($config['HTMLEncode'],0,1) == "Y") {
		Header("Content-type: text/plain; charset=ISO-8859-1");
		echo htmlspecialchars($outputdata);
	}
	else {
		echo $outputdata;
	}
}

?>