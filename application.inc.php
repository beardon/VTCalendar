<?php
// Allow any script that includes this file to include php files that restrict their access.
define("ALLOWINCLUDES", TRUE);

// Include Pear::DB or output an error message if it does not exist.
@(include_once('DB.php')) or die('Pear::DB does not seem to be installed. See: http://pear.php.net/package/DB');

// Include the necessary VTCalendar files.
@(include_once('version.inc.php')); // TODO: Should this fail if the file cannot be loaded?
@(include_once('config.inc.php')) or die('config.inc.php was not found. See: <a href="install/index.php">VTCalendar Installation</a>.');
require_once('config-defaults.inc.php');
require_once('config-colordefaults.inc.php');
require_once('config-validation.inc.php');
require_once('session_start.inc.php');
require_once('functions.inc.php');
require_once('languages/en.inc.php');
if (LANGUAGE != 'en') require_once('languages/'.LANGUAGE.'.inc.php');
require_once('constants.inc.php');

if (AUTH_LDAP && !function_exists("ldap_connect")) {
	echo "PHP LDAP does not seem to be installed or configured. Make sure the extension is included in your php.ini file.";
	exit();
}

// Include Pear::Mail or output an error message if it does not exist.
if (EMAIL_USEPEAR) {
	@(include_once('Mail.php')) or die('Pear::Mail is required when EMAIL_USERPEAR is set to true. See: http://pear.php.net/package/Mail');
}

// Include Pear::HTTP_Request if AUTH_HTTP is true, or output an error message if it does not exist.
if (AUTH_HTTP) {
	@(include_once("HTTP/Request.php")) or die("Pear::HTTP_Request is required when using HTTP authentication. See: http://pear.php.net/package/HTTP_Request");
}

/* ============================================================
                Open the database connection
============================================================ */

if (!defined("NOLOADDB")) {
	$DBCONNECTION =& DBOpen();
	if (is_string($DBCONNECTION)) {
		include("dberror.php");
		exit;
	}
}

/* ============================================================
           Load the calendar preferences and logout
============================================================ */

// Get the specified calendar ID from the query string, either as 'calendarid' or 'calendar'.
if (isset($_GET['calendarid'])) {
	$calendarid = $_GET['calendarid'];
}
elseif (isset($_GET['calendar'])) {
	$calendarid = $_GET['calendar'];
}

// Unset the calendar ID if it is invalid.
if (isset($calendarid) && !isValidInput($calendarid,'calendarid')) {
	unset($calendarid);
}

// Unset the calendar ID if it is already set in the session.
if (isset($_SESSION['CALENDAR_ID']) && isset($calendarid) && $_SESSION['CALENDAR_ID'] == $calendarid) {
	unset($calendarid);
}

// Set a default calendar if one was not specified in the query string or session.
if (!isset($_SESSION['CALENDAR_ID']) && !isset($calendarid)) {
	$calendarid = "default";
}

// If the calendar ID was specified then load that calendar
if (isset($calendarid) && !defined("NOLOADDB")) { 
	if (calendar_exists($calendarid)) { 
		$_SESSION['CALENDAR_ID'] = $calendarid;
		setCalendarPreferences();
		calendarlogout();
	}
}

/* ============================================================
                  Fixes for slow browsers
============================================================ */
if ( isset($_SERVER["HTTP_USER_AGENT"]) && $_SERVER["HTTP_USER_AGENT"] == "Mozilla/4.0 (compatible; MSIE 5.22; Mac_PowerPC)" ) {
	$enableViewMonth = false;
} 
else { 
	$enableViewMonth = true; 
}
?>