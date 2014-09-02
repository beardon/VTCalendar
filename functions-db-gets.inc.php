<?php
// Gets the data for a calendar.
// Returns a DB row if successful.
// Returns a number if more than one row was found.
// Returns a string of a DB error occurred.
function getCalendarData($calendarid) {
	$result =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_calendar WHERE id='".sqlescape($calendarid)."'");
	
	if ( is_string($result) ) {
		return $result;
	}
	elseif ($result->numRows() != 1) {
		return $result->numRows();
	}
	else {
		return $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	}
}

// Determine if a calendar with the specified ID exists.
// Returns true if the calendar eixsts. False otherwise.
// Returns a string of a DB error occurred.
function calendar_exists($calendarid) {
	$result = DBQuery("SELECT count(id) FROM ".TABLEPREFIX."vtcal_calendar WHERE id='".sqlescape($calendarid)."'" );
	$r = $result->fetchRow(0);
	return ($r[0]==1);
}

function setCalendarPreferences() {
	$result =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_calendar WHERE id='".sqlescape($_SESSION['CALENDAR_ID'])."'" );
	if (is_string($result)) return $result;
	
	if ($result->numRows() == 1) {
		$calendar =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
		$_SESSION['CALENDAR_TITLE'] = $calendar['title'];
		$_SESSION['CALENDAR_NAME'] = $calendar['name'];
		$_SESSION['CALENDAR_HEADER'] = $calendar['header'];
		$_SESSION['CALENDAR_FOOTER'] = $calendar['footer'];
		$_SESSION['CALENDAR_VIEWAUTHREQUIRED'] = $calendar['viewauthrequired'];
		$_SESSION['CALENDAR_FORWARD_EVENT_BY_DEFAULT'] = $calendar['forwardeventdefault'];
	}
	$result->free();

	$result =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_colors WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."'" );
	if (is_string($result)) return $result;
	
	if ($result->numRows() == 1) {
		$record =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	}
	
	// The following block should only come from the output of color-loadfromdb.xsl (run against colors.xml).
	// START GENERATED
	if (!isset($record['bg']) || !setVar($_SESSION['COLOR_BG'], $record['bg'], 'color')) $_SESSION['COLOR_BG'] = DEFAULTCOLOR_BG;
	if (!isset($record['text']) || !setVar($_SESSION['COLOR_TEXT'], $record['text'], 'color')) $_SESSION['COLOR_TEXT'] = DEFAULTCOLOR_TEXT;
	if (!isset($record['text_faded']) || !setVar($_SESSION['COLOR_TEXT_FADED'], $record['text_faded'], 'color')) $_SESSION['COLOR_TEXT_FADED'] = DEFAULTCOLOR_TEXT_FADED;
	if (!isset($record['text_warning']) || !setVar($_SESSION['COLOR_TEXT_WARNING'], $record['text_warning'], 'color')) $_SESSION['COLOR_TEXT_WARNING'] = DEFAULTCOLOR_TEXT_WARNING;
	if (!isset($record['link']) || !setVar($_SESSION['COLOR_LINK'], $record['link'], 'color')) $_SESSION['COLOR_LINK'] = DEFAULTCOLOR_LINK;
	if (!isset($record['body']) || !setVar($_SESSION['COLOR_BODY'], $record['body'], 'color')) $_SESSION['COLOR_BODY'] = DEFAULTCOLOR_BODY;
	if (!isset($record['today']) || !setVar($_SESSION['COLOR_TODAY'], $record['today'], 'color')) $_SESSION['COLOR_TODAY'] = DEFAULTCOLOR_TODAY;
	if (!isset($record['todaylight']) || !setVar($_SESSION['COLOR_TODAYLIGHT'], $record['todaylight'], 'color')) $_SESSION['COLOR_TODAYLIGHT'] = DEFAULTCOLOR_TODAYLIGHT;
	if (!isset($record['light_cell_bg']) || !setVar($_SESSION['COLOR_LIGHT_CELL_BG'], $record['light_cell_bg'], 'color')) $_SESSION['COLOR_LIGHT_CELL_BG'] = DEFAULTCOLOR_LIGHT_CELL_BG;
	if (!isset($record['table_header_text']) || !setVar($_SESSION['COLOR_TABLE_HEADER_TEXT'], $record['table_header_text'], 'color')) $_SESSION['COLOR_TABLE_HEADER_TEXT'] = DEFAULTCOLOR_TABLE_HEADER_TEXT;
	if (!isset($record['table_header_bg']) || !setVar($_SESSION['COLOR_TABLE_HEADER_BG'], $record['table_header_bg'], 'color')) $_SESSION['COLOR_TABLE_HEADER_BG'] = DEFAULTCOLOR_TABLE_HEADER_BG;
	if (!isset($record['border']) || !setVar($_SESSION['COLOR_BORDER'], $record['border'], 'color')) $_SESSION['COLOR_BORDER'] = DEFAULTCOLOR_BORDER;
	if (!isset($record['keyword_highlight']) || !setVar($_SESSION['COLOR_KEYWORD_HIGHLIGHT'], $record['keyword_highlight'], 'color')) $_SESSION['COLOR_KEYWORD_HIGHLIGHT'] = DEFAULTCOLOR_KEYWORD_HIGHLIGHT;
	if (!isset($record['h2']) || !setVar($_SESSION['COLOR_H2'], $record['h2'], 'color')) $_SESSION['COLOR_H2'] = DEFAULTCOLOR_H2;
	if (!isset($record['h3']) || !setVar($_SESSION['COLOR_H3'], $record['h3'], 'color')) $_SESSION['COLOR_H3'] = DEFAULTCOLOR_H3;
	if (!isset($record['title']) || !setVar($_SESSION['COLOR_TITLE'], $record['title'], 'color')) $_SESSION['COLOR_TITLE'] = DEFAULTCOLOR_TITLE;
	if (!isset($record['tabgrayed_text']) || !setVar($_SESSION['COLOR_TABGRAYED_TEXT'], $record['tabgrayed_text'], 'color')) $_SESSION['COLOR_TABGRAYED_TEXT'] = DEFAULTCOLOR_TABGRAYED_TEXT;
	if (!isset($record['tabgrayed_bg']) || !setVar($_SESSION['COLOR_TABGRAYED_BG'], $record['tabgrayed_bg'], 'color')) $_SESSION['COLOR_TABGRAYED_BG'] = DEFAULTCOLOR_TABGRAYED_BG;
	if (!isset($record['filternotice_bg']) || !setVar($_SESSION['COLOR_FILTERNOTICE_BG'], $record['filternotice_bg'], 'color')) $_SESSION['COLOR_FILTERNOTICE_BG'] = DEFAULTCOLOR_FILTERNOTICE_BG;
	if (!isset($record['filternotice_font']) || !setVar($_SESSION['COLOR_FILTERNOTICE_FONT'], $record['filternotice_font'], 'color')) $_SESSION['COLOR_FILTERNOTICE_FONT'] = DEFAULTCOLOR_FILTERNOTICE_FONT;
	if (!isset($record['filternotice_fontfaded']) || !setVar($_SESSION['COLOR_FILTERNOTICE_FONTFADED'], $record['filternotice_fontfaded'], 'color')) $_SESSION['COLOR_FILTERNOTICE_FONTFADED'] = DEFAULTCOLOR_FILTERNOTICE_FONTFADED;
	if (!isset($record['filternotice_bgimage']) || !setVar($_SESSION['COLOR_FILTERNOTICE_BGIMAGE'], $record['filternotice_bgimage'], 'color')) $_SESSION['COLOR_FILTERNOTICE_BGIMAGE'] = DEFAULTCOLOR_FILTERNOTICE_BGIMAGE;
	if (!isset($record['eventbar_past']) || !setVar($_SESSION['COLOR_EVENTBAR_PAST'], $record['eventbar_past'], 'color')) $_SESSION['COLOR_EVENTBAR_PAST'] = DEFAULTCOLOR_EVENTBAR_PAST;
	if (!isset($record['eventbar_current']) || !setVar($_SESSION['COLOR_EVENTBAR_CURRENT'], $record['eventbar_current'], 'color')) $_SESSION['COLOR_EVENTBAR_CURRENT'] = DEFAULTCOLOR_EVENTBAR_CURRENT;
	if (!isset($record['eventbar_future']) || !setVar($_SESSION['COLOR_EVENTBAR_FUTURE'], $record['eventbar_future'], 'color')) $_SESSION['COLOR_EVENTBAR_FUTURE'] = DEFAULTCOLOR_EVENTBAR_FUTURE;
	if (!isset($record['monthdaylabels_past']) || !setVar($_SESSION['COLOR_MONTHDAYLABELS_PAST'], $record['monthdaylabels_past'], 'color')) $_SESSION['COLOR_MONTHDAYLABELS_PAST'] = DEFAULTCOLOR_MONTHDAYLABELS_PAST;
	if (!isset($record['monthdaylabels_current']) || !setVar($_SESSION['COLOR_MONTHDAYLABELS_CURRENT'], $record['monthdaylabels_current'], 'color')) $_SESSION['COLOR_MONTHDAYLABELS_CURRENT'] = DEFAULTCOLOR_MONTHDAYLABELS_CURRENT;
	if (!isset($record['monthdaylabels_future']) || !setVar($_SESSION['COLOR_MONTHDAYLABELS_FUTURE'], $record['monthdaylabels_future'], 'color')) $_SESSION['COLOR_MONTHDAYLABELS_FUTURE'] = DEFAULTCOLOR_MONTHDAYLABELS_FUTURE;
	if (!isset($record['othermonth']) || !setVar($_SESSION['COLOR_OTHERMONTH'], $record['othermonth'], 'color')) $_SESSION['COLOR_OTHERMONTH'] = DEFAULTCOLOR_OTHERMONTH;
	if (!isset($record['littlecal_today']) || !setVar($_SESSION['COLOR_LITTLECAL_TODAY'], $record['littlecal_today'], 'color')) $_SESSION['COLOR_LITTLECAL_TODAY'] = DEFAULTCOLOR_LITTLECAL_TODAY;
	if (!isset($record['littlecal_highlight']) || !setVar($_SESSION['COLOR_LITTLECAL_HIGHLIGHT'], $record['littlecal_highlight'], 'color')) $_SESSION['COLOR_LITTLECAL_HIGHLIGHT'] = DEFAULTCOLOR_LITTLECAL_HIGHLIGHT;
	if (!isset($record['littlecal_fontfaded']) || !setVar($_SESSION['COLOR_LITTLECAL_FONTFADED'], $record['littlecal_fontfaded'], 'color')) $_SESSION['COLOR_LITTLECAL_FONTFADED'] = DEFAULTCOLOR_LITTLECAL_FONTFADED;
	if (!isset($record['littlecal_line']) || !setVar($_SESSION['COLOR_LITTLECAL_LINE'], $record['littlecal_line'], 'color')) $_SESSION['COLOR_LITTLECAL_LINE'] = DEFAULTCOLOR_LITTLECAL_LINE;
	if (!isset($record['gobtn_bg']) || !setVar($_SESSION['COLOR_GOBTN_BG'], $record['gobtn_bg'], 'color')) $_SESSION['COLOR_GOBTN_BG'] = DEFAULTCOLOR_GOBTN_BG;
	if (!isset($record['gobtn_border']) || !setVar($_SESSION['COLOR_GOBTN_BORDER'], $record['gobtn_border'], 'color')) $_SESSION['COLOR_GOBTN_BORDER'] = DEFAULTCOLOR_GOBTN_BORDER;
	if (!isset($record['newborder']) || !setVar($_SESSION['COLOR_NEWBORDER'], $record['newborder'], 'color')) $_SESSION['COLOR_NEWBORDER'] = DEFAULTCOLOR_NEWBORDER;
	if (!isset($record['newbg']) || !setVar($_SESSION['COLOR_NEWBG'], $record['newbg'], 'color')) $_SESSION['COLOR_NEWBG'] = DEFAULTCOLOR_NEWBG;
	if (!isset($record['approveborder']) || !setVar($_SESSION['COLOR_APPROVEBORDER'], $record['approveborder'], 'color')) $_SESSION['COLOR_APPROVEBORDER'] = DEFAULTCOLOR_APPROVEBORDER;
	if (!isset($record['approvebg']) || !setVar($_SESSION['COLOR_APPROVEBG'], $record['approvebg'], 'color')) $_SESSION['COLOR_APPROVEBG'] = DEFAULTCOLOR_APPROVEBG;
	if (!isset($record['copyborder']) || !setVar($_SESSION['COLOR_COPYBORDER'], $record['copyborder'], 'color')) $_SESSION['COLOR_COPYBORDER'] = DEFAULTCOLOR_COPYBORDER;
	if (!isset($record['copybg']) || !setVar($_SESSION['COLOR_COPYBG'], $record['copybg'], 'color')) $_SESSION['COLOR_COPYBG'] = DEFAULTCOLOR_COPYBG;
	if (!isset($record['deleteborder']) || !setVar($_SESSION['COLOR_DELETEBORDER'], $record['deleteborder'], 'color')) $_SESSION['COLOR_DELETEBORDER'] = DEFAULTCOLOR_DELETEBORDER;
	if (!isset($record['deletebg']) || !setVar($_SESSION['COLOR_DELETEBG'], $record['deletebg'], 'color')) $_SESSION['COLOR_DELETEBG'] = DEFAULTCOLOR_DELETEBG;
	// END GENERATED
	
	if (isset($result)) {
		$result->free();
	}
	
	$result =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND admin='1'" );
	if (is_string($result)) return $result;
	$sponsor =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	$_SESSION['CALENDAR_ADMINEMAIL'] = $sponsor['email'];
	$result->free();
	
	return true;
}

function getNumCategories() {
	$result = DBQuery("SELECT count(*) FROM ".TABLEPREFIX."vtcal_category WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."'" ); 
	$r = $result->fetchRow(0);
	return $r[0];
}

/* Get the name of a category from the database */
function getCategoryName($categoryid) {
	$result = DBQuery("SELECT name FROM ".TABLEPREFIX."vtcal_category WHERE id='".sqlescape($categoryid)."'" );
	if ($result->numRows() > 0) {
		$category = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
		return $category['name'];
	}
	else {
		return "";
	}
}

/* Get the name of a calendar from the database */
function getCalendarName($calendarid) {
	$result = DBQuery("SELECT name FROM ".TABLEPREFIX."vtcal_calendar WHERE id='".sqlescape($calendarid)."'" );
	if ($result->numRows() > 0) {
		$calendar = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
		return $calendar['name'];
	}
	else {
		return "";
	}
}

/* Get the name of a calendar that a sponsor belongs to from the database */
function getSponsorCalendarName($sponsorid) {
	$result = DBQuery("SELECT c.name FROM ".TABLEPREFIX."vtcal_sponsor AS s, ".TABLEPREFIX."vtcal_calendar AS c WHERE s.id = '".sqlescape($sponsorid)."' AND c.id = s.calendarid");
	if ($result->numRows() > 0) {
		$calendar = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
		return $calendar['name'];
	}
	else {
		return "";
	}
}

/* Get the name of a sponsor from the database */
function getSponsorName($sponsorid) {
	$result = DBQuery("SELECT name FROM ".TABLEPREFIX."vtcal_sponsor WHERE id='".sqlescape($sponsorid)."'" );
	if ($result->numRows() > 0) {
		$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
		return $sponsor['name'];
	}
	else {
		return "";
	}
}

/* Get the URL of a sponsor from the database */
function getSponsorURL($sponsorid) {
	$result = DBQuery("SELECT url FROM ".TABLEPREFIX."vtcal_sponsor WHERE id='".sqlescape($sponsorid)."'" );
	if ($result->numRows() > 0) {
		$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
		return $sponsor['url'];
	}
	else {
		return "";
	}
}

// Get the number of unapproved events for an entire calendar. */
function num_unapprovedevents($repeatid) {
	$result = DBQuery("SELECT id FROM ".TABLEPREFIX."vtcal_event WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND repeatid='".sqlescape($repeatid)."' AND approved=0"); 
	return $result->numRows();
}

// returns true if a particular userid exists in the database
function userExistsInDB($userid) {
	if ( AUTH_DB ) {
		$query = "SELECT count(id) FROM ".TABLEPREFIX."vtcal_user WHERE id='".sqlescape($userid)."'";
		$result = DBQuery($query ); 
		$r = $result->fetchRow(0);
		if ($r[0]>0) { return true; }
	}
	
	return false; // default rule
}

// returns true if the user-id is valid
function isValidUser($userid) {
	
	// If we are using HTTP authentication, we must assume all
	// users are valid, since we have no way of verifying HTTP users.
	if ( AUTH_HTTP ) {
		return true;
	}
	
	if ( AUTH_DB ) {
		$query = "SELECT count(id) FROM ".TABLEPREFIX."vtcal_user WHERE id='".sqlescape($userid)."'";
		$result = DBQuery($query ); 
		$r = $result->fetchRow(0);
		if ($r[0]>0) { return true; }
	}
	
	if ( AUTH_LDAP ) {
		// TODO: Checks against the LDAP
		return preg_match(REGEXVALIDUSERID, $userid);
	}

	return false; // default rule
}

/**
 * Build a query for exporting events.
 * @param int the ID for calendar to retrieve events from.
 * @param array the parameters to get the query by.
 * @return string the query.
 */
function BuildExportQuery($CalendarID, &$FormData) {
	$query = "SELECT e.*, c.name as category_name, s.name as sponsor_name"
		." FROM ".TABLEPREFIX."vtcal_event_public e, ".TABLEPREFIX."vtcal_sponsor s, ".TABLEPREFIX."vtcal_category c"
		." WHERE e.calendarid='". sqlescape($CalendarID) ."' AND e.categoryid = c.id AND e.sponsorid = s.id";
	
	// Ignore other filters if an ID was specified.
	if (isset($FormData['id'])) {
		$query .= " AND e.id='".sqlescape($FormData['id'])."' ";
	}
	else {
		// Filter by date.
		if (isset($FormData['timebegin'])) {
			if ($FormData['timebegin'] == "upcoming") {
				$query .= " AND e.timeend > '" . sqlescape(NOW_AS_TEXT) ."' ";
				$BeginTicks = NOW;
			}
			elseif ($FormData['timebegin'] == "today") {
				$query .= " AND e.timebegin >= '" . sqlescape(substr(NOW_AS_TEXT, 0, 10))." 00:00:00' ";
				$BeginTicks = NOW;
			}
			else {
				$query .= " AND e.timebegin >= '" . sqlescape($FormData['timebegin']). " 00:00:00' ";
				$BeginTicks = strtotime($FormData['timebegin']);
			}
			
			if (isset($FormData['timeend'])) {
				if (isValidInput($FormData['timeend'], 'int_gte1')) {
					$query .= " AND e.timeend <= '" . sqlescape(date("Y-m-d", strtotime($FormData['timeend']." day", $BeginTicks))) . " 23:59:59' ";
				}
				else {
					$query .= " AND e.timeend <= '" . sqlescape($FormData['timeend']). " 23:59:59' ";
				}
			}
		}
		
		// Show only the specified categories.
		if (isset($FormData['categories']) && count($FormData['categories']) > 0) {
			$query .= " AND (";
			for ($i = 0; $i < count($FormData['categories']); $i++) {
				if ($i > 0) $query .= " OR ";
				$query .= " e.categoryid = '".sqlescape($FormData['categories'][$i])."' ";
			}
			$query .= ") ";
		}
		
		// Filter by the specified sponsor string, if one was specified.
		if ($FormData['sponsor'] == "specific") {
			$query .= " AND e.displayedsponsor LIKE '%" . sqlescape($FormData['specificsponsor']) . "%'";
		}
	
		// Order the query
		$query .= " ORDER BY e.timebegin, e.title";
	}
	
	// Append a LIMIT if a maximum number of events was specified.
	if (isset($FormData['maxevents'])) $query .= ' LIMIT ' . $FormData['maxevents'];
	
	return $query;
}
?>