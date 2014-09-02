<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

	// read event from the DB
	$query = "SELECT e.id AS eventid,e.timebegin,e.timeend,e.sponsorid,e.title,e.location,e.description,e.contact_name,e.contact_email,e.contact_phone,e.price,e.displayedsponsor,e.displayedsponsorurl,e.wholedayevent,e.categoryid,c.id,c.name AS category_name FROM ".TABLEPREFIX."vtcal_event_public e, ".TABLEPREFIX."vtcal_category c WHERE e.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND c.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND e.categoryid=c.id AND e.id='".sqlescape($eventid)."'";
	$result =& DBQuery($query );
	
	if ( !is_string($result) && $result->numRows() > 0 ) {
		$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
 	  disassemble_timestamp($event);	
		$event_timebegin  = timestamp2datetime($event['timebegin']);
		$event_timeend    = timestamp2datetime($event['timeend']);
		$basetitle = ": ".htmlentities($event['title']);
	}
?>