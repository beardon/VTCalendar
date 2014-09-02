<?php
require_once('application.inc.php');
require_once('main_globalsettings.inc.php');

// Verify that the user is authorized.
if (!viewauthorized()) { exit; }

// By default, do not show the "today" color.
$IsTodayBodyColor = 0;
	
// if only today is shown highlight it
if ( $view == "day" ) { 
	if ( $showdate['day'] == $today['day'] && $showdate['month'] == $today['month'] && $showdate['year'] == $today['year']) {
		$IsTodayBodyColor = 1;
	}
}

// Load the category names from the DB if they are not stored in the session.
if (empty($_SESSION['CATEGORY_NAMES'])) {

	// Retrieve all categories from the DB
	$result =& DBQuery("SELECT id, name FROM ".SCHEMANAME."vtcal_category WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' ORDER BY name" );
	
	if (is_string($result)) {
		DBErrorBox($result);
		exit();
	}
	else {
		$numcategories = $result->numRows();
		
		// Setup a variable to hold the data to store in the session variable.
		if ($numcategories <= MAX_CACHESIZE_CATEGORYNAME)
			$sessiondata = "";
		
		// Loop through all the categories for this calendar.
		for ($c=0; $c < $numcategories; $c++) {
			$categorydata =& $result->fetchRow(DB_FETCHMODE_ASSOC, $c);
			
			if ($numcategories <= MAX_CACHESIZE_CATEGORYNAME) {
				if ($c > 0) $sessiondata .= "\n";
				
				$sessiondata .= $categorydata['id'] . "\t" . $categorydata['name'];
			}
			
			$categories_id[$c]= $categorydata['id'];
			$categories_name[$c]= $categorydata['name'];
		}
		
		// Set the session data to a session variable.
		if ($numcategories <= MAX_CACHESIZE_CATEGORYNAME)
			$_SESSION['CATEGORY_NAMES'] = $sessiondata;
	}
}

// Otherwise, process the category names stored in the session.
else {
	$splitSessionData = explode("\n", $_SESSION['CATEGORY_NAMES']);
	$numcategories = count($splitSessionData);
	
	for ($i=0; $i < count($splitSessionData); $i++) {
		$splitCategoryData = explode("\t", $splitSessionData[$i]);
		$categories_id[$i]= $splitCategoryData[0];
		$categories_name[$i]= $splitCategoryData[1];
	}
}

// Split the category filter if it was specified as a string.
if (isset($CategoryFilter) && is_string($CategoryFilter)) {
	$CategoryFilter = explode(",", $CategoryFilter);
}

// Clear the category filter if the number of categories in the
// filter matches the total number of categories for the calendar.
if (isset($CategoryFilter) && count($CategoryFilter) == $numcategories) {
	unset($CategoryFilter);
	unset($_SESSION['CATEGORY_FILTER']);
}

// Process filtered categories if they were set in the URL
elseif (isset($CategoryFilter)) {
	$SessionData = "";
	for($i = 0; $i < count($CategoryFilter); $i++) {
		if ($i > 0) $SessionData .= ",";
		$SessionData .= $CategoryFilter[$i];
	}
	
	// Set the category filter to the session.
	$_SESSION['CATEGORY_FILTER'] = $SessionData;
}

// Otherwise, check for existence of a cookie and process it.
elseif (isset($_SESSION['CATEGORY_FILTER'])) {
	$CategoryFilter = split(",", $_SESSION['CATEGORY_FILTER']);
}

// The base text for the page title, which can be changed by the main_(view)_data.inc.php files.
$basetitle = "";

// Load any information that we may need to display in the header.
// Typically this only changes the base title, however, it may load data from the database.
// A situation where it will do this is with events, since it will want to output the event title in the <title> tag.
require("main_".$view."_data.inc.php");

// Output the header HTML
if ( $view == "upcoming" ) {
	pageheader(lang('upcoming_page_header').$basetitle, "Upcoming");
}
elseif ( $view == "day" ) {
	pageheader(lang('day_page_header').$basetitle, "Day");
}
elseif ( $view == "week" ) {
	pageheader(lang('week_page_header').$basetitle, "Week");
}
elseif ( $view == "month" ) { 
	pageheader(lang('month_page_header').$basetitle, "Month");
}
elseif ( $view == "event" ) { 
	pageheader(lang('event_page_header').$basetitle, "");
}
elseif ( $view == "search" ) { 
	pageheader(lang('search_page_header').$basetitle, "Search");
}
elseif ( $view == "searchresults" ) { 
	pageheader(lang('searchresults_page_header').$basetitle, "SearchResults");
}
elseif ( $view == "subscribe" ) { 
	pageheader(lang('subscribe_page_header').$basetitle, "Subscribe");
}
elseif ( $view == "filter" ) { 
	pageheader(lang('filter_page_header').$basetitle, "Filter");
}
elseif ( $view == "export" ) { 
	pageheader(lang('export_page_header').$basetitle, "Export");
}

// Output the calendar table.
?>
<table id="CalendarTable" width="100%" border="0" cellpadding="8" cellspacing="0">
<tr>
	
<?php
// If the column should be on the left, output it first then the body.
if (COLUMNSIDE == "LEFT") {
	include('main_column.inc.php');
	include('main_body.inc.php');
}
// If the column should be on the right, output the body then the column.
elseif (COLUMNSIDE == "RIGHT") {
	include('main_body.inc.php');
	include('main_column.inc.php');
}
?>

</tr>
</table>
<table id="PoweredBy" width="100%" border="0" cellpadding="4" cellspacing="0"><tr><td align="right">Powered by <a href="http://vtcalendar.sourceforge.net/" target="_blank">VTCalendar</a> <?php
	if (defined("VERSION")) {
		echo VERSION;
		if (defined("VERSION_EXTENSION")) {
			echo VERSION_EXTENSION;
		}
	}
		
	?>.</td></tr></table>

<?php

/*ob_start();
var_dump($_SESSION);
$output = ob_get_contents();
ob_end_clean();
echo "<pre>".htmlentities($output)."</pre>";*/

pagefooter();
DBclose();
?>