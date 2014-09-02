<?php
/* Remove an event from the event table (aka: still under review) for the current calendar,
and from the default calendar if the event was submitted to it. */
function deletefromevent($eventid) {
	$query = "DELETE FROM vtcal_event WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'";
	$result =& DBQuery($query); 
	if (is_string($result)) return $result;

	// delete event from default calendar if it had been forwarded
	if ( $_SESSION['CALENDAR_ID'] != "default" ) {
		// delete existing events in default calendar with same id
		$query = "DELETE FROM vtcal_event WHERE calendarid='default' AND id='".sqlescape($eventid)."'";
		$result =& DBQuery($query ); 
		if (is_string($result)) return $result;
	}
	
	return true;
}

/* Remove an event from the event_public table (aka: the event will no longer be public) */
function deletefromevent_public($eventid) {
	$query = "DELETE FROM vtcal_event_public WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'";
	$result =& DBQuery($query ); 
}

/* Remove all repeating entries from the event table (aka: still under review) for the current calendar,
and from the default calendar if the event was submitted to it. */
function repeatdeletefromevent($repeatid) {
	if (!empty($repeatid)) {
		$query = "DELETE FROM vtcal_event WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND repeatid='".sqlescape($repeatid)."'";
		$result =& DBQuery($query); 
		if (is_string($result)) return $result;
	
		// delete event from default calendar if it had been forwarded
		if ( $_SESSION['CALENDAR_ID'] != "default" ) {
			// delete existing events in default calendar with same id
			$query = "DELETE FROM vtcal_event WHERE calendarid='default' AND repeatid='".sqlescape($repeatid)."'";
			$result =& DBQuery($query);
			if (is_string($result)) return $result;
		}
	}
	return true;
}

/* Remove all repeating entries from the event_public table (aka: the event will no longer be public),
and from the default calendar if the event was submitted to it. */
function repeatdeletefromevent_public($repeatid) {
	if (!empty($repeatid)) {
		$query = "DELETE FROM vtcal_event_public WHERE calendarid='".$_SESSION['CALENDAR_ID']."' AND repeatid='".sqlescape($repeatid)."'";
		$result =& DBQuery($query); 
		if (is_string($result)) return $result;

		// delete event from default calendar if it had been forwarded
		if ( $_SESSION['CALENDAR_ID'] != "default" ) {
			// delete existing events in default calendar with same id
			$query = "DELETE FROM vtcal_event_public WHERE calendarid='default' AND repeatid='".sqlescape($repeatid)."'";
			$result =& DBQuery($query); 
			if (is_string($result)) return $result;
		}
	}
	return true;
}

/* Remove all repeating entries from the event table (aka: still under review) for the current calendar. */
function deletefromrepeat($repeatid) {
	if (!empty($repeatid)) {
		$query = "DELETE FROM vtcal_event_repeat WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($repeatid)."'";
		$result =& DBQuery($query); 
		if (is_string($result)) return $result;
	}
	return true;
}

function insertintoevent($eventid, &$event) {
	return insertintoeventsql($_SESSION['CALENDAR_ID'],$eventid,$event);
}

function insertintoeventsql($calendarid, $eventid, &$event) {
	$changed = date("Y-m-d H:i:s");
	$query = "INSERT INTO vtcal_event (calendarid,id,approved,rejectreason,timebegin,timeend,repeatid,sponsorid,displayedsponsor,displayedsponsorurl,title,wholedayevent,categoryid,description,location,price,contact_name,contact_phone,contact_email,url,recordchangedtime,recordchangeduser,showondefaultcal,showincategory) ";
	$query.= "VALUES ('".sqlescape($calendarid)."','".sqlescape($eventid)."',0,'";
	if (!empty($event['rejectreason'])) {
		$query.= sqlescape($event['rejectreason']);
	}
	$query.= "','";
	$query.= sqlescape($event['timebegin'])."','";
	$query.= sqlescape($event['timeend'])."','".sqlescape($event['repeatid'])."','";
	$query.= sqlescape($event['sponsorid'])."','".sqlescape($event['displayedsponsor'])."','";
	$query.= sqlescape($event['displayedsponsorurl'])."','".sqlescape($event['title'])."','";
	$query.= sqlescape($event['wholedayevent'])."','".sqlescape($event['categoryid'])."','";
	$query.= sqlescape($event['description'])."','".sqlescape($event['location'])."','";
	$query.= sqlescape($event['price'])."','".sqlescape($event['contact_name'])."','";
	$query.= sqlescape($event['contact_phone'])."','".sqlescape($event['contact_email'])."','";
	$query.= sqlescape($event['url'])."','".sqlescape($changed)."','";
	if (isset($event['showondefaultcal'])) { $showondefaultcal = $event['showondefaultcal']; } else { $showondefaultcal = 0; }
	$query.= sqlescape($_SESSION["AUTH_USERID"])."','".sqlescape($showondefaultcal)."','";
	if (isset($event['showincategory'])) { $showincategory = $event['showincategory']; } else { $showincategory = 0; }
	$query.= sqlescape($showincategory)."')";
	
	$result =& DBQuery($query);
	if (is_string($result)) return $result;
	
	//echo $result;
	return $eventid;
}

function insertintoevent_public(&$event) {
	$changed = date ("Y-m-d H:i:s");
	$query = "INSERT INTO vtcal_event_public (calendarid,id,timebegin,timeend,repeatid,sponsorid,displayedsponsor,displayedsponsorurl,title,wholedayevent,categoryid,description,location,price,contact_name,contact_phone,contact_email,url,recordchangedtime,recordchangeduser) VALUES ";
	$query.= "('".sqlescape($_SESSION['CALENDAR_ID'])."','".sqlescape($event['id'])."','";
	$query.= sqlescape($event['timebegin'])."','";
	$query.= sqlescape($event['timeend'])."','".sqlescape($event['repeatid'])."','";
	$query.= sqlescape($event['sponsorid'])."','".sqlescape($event['displayedsponsor'])."','";
	$query.= sqlescape($event['displayedsponsorurl'])."','".sqlescape($event['title'])."','";
	$query.= sqlescape($event['wholedayevent'])."','".sqlescape($event['categoryid'])."','";
	$query.= sqlescape($event['description'])."','".sqlescape($event['location'])."','";
	$query.= sqlescape($event['price'])."','".sqlescape($event['contact_name'])."','";
	$query.= sqlescape($event['contact_phone'])."','".sqlescape($event['contact_email'])."','";
	$query.= sqlescape($event['url'])."','".sqlescape($changed)."','";
	$query.= sqlescape($_SESSION["AUTH_USERID"])."')";

	$result =& DBQuery($query); 
	if (is_string($result)) return $result;
	
	return true;
}

function updateevent($eventid, &$event) {
	$changed = date ("Y-m-d H:i:s");
	$query = "UPDATE vtcal_event SET approved=0, rejectreason='".sqlescape($event['rejectreason']);
	$query.= "',timebegin='".sqlescape($event['timebegin'])."',timeend='".sqlescape($event['timeend']);
	$query.= "',repeatid='".sqlescape($event['repeatid'])."',sponsorid='".sqlescape($event['sponsorid']);
	$query.= "',displayedsponsor='".sqlescape($event['displayedsponsor'])."',displayedsponsorurl='".sqlescape($event['displayedsponsorurl']);
	$query.= "',title='".sqlescape($event['title'])."',wholedayevent='".sqlescape($event['wholedayevent']);
	$query.= "',categoryid='".sqlescape($event['categoryid'])."',description='".sqlescape($event['description']);
	$query.= "',location='".sqlescape($event['location'])."',price='".sqlescape($event['price']);
	$query.= "',contact_name='".sqlescape($event['contact_name'])."',contact_phone='".sqlescape($event['contact_phone']);
	$query.= "',contact_email='".sqlescape($event['contact_email'])."',url='".sqlescape($event['url']);
	$query.= "',recordchangedtime='".sqlescape($changed)."',recordchangeduser='".sqlescape($_SESSION["AUTH_USERID"]);
	$query.= "',showondefaultcal='".sqlescape($event['showondefaultcal'])."',showincategory='".sqlescape($event['showincategory'])."' ";
	$query.= "WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'";
	$result =& DBQuery($query );
	if (is_string($result)) return $result;
	
	return true;
}

function updateevent_public($eventid, &$event) {
	$changed = date ("Y-m-d H:i:s");
	$query = "UPDATE vtcal_event_public SET timebegin='".sqlescape($event['timebegin']);
	$query.= "',timeend='".sqlescape($event['timeend'])."',repeatid='".sqlescape($event['repeatid']);
	$query.= "',sponsorid='".sqlescape($event['sponsorid'])."',displayedsponsor='".sqlescape($event['displayedsponsor']);
	$query.= "',displayedsponsorurl='".sqlescape($event['displayedsponsorurl'])."',title='".sqlescape($event['title']);
	$query.= "',wholedayevent='".sqlescape($event['wholedayevent'])."',categoryid='".sqlescape($event['categoryid']);
	$query.= "',description='".sqlescape($event['description'])."',location='".sqlescape($event['location']);
	$query.= "',price='".sqlescape($event['price'])."',contact_name='".sqlescape($event['contact_name']);
	$query.= "',contact_phone='".sqlescape($event['contact_phone'])."',contact_email='".sqlescape($event['contact_email']);
	$query.= "',url='".sqlescape($event['url'])."',recordchangedtime='".sqlescape($changed);
	$query.= "',recordchangeduser='".sqlescape($_SESSION["AUTH_USERID"]);
	$query.= "' WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'";
	$result =& DBQuery($query);
	if (is_string($result)) return $result;
	
	return true;
}

function insertintotemplate($template_name, &$event) {
	$changed = date ("Y-m-d H:i:s");
	$query = "INSERT INTO vtcal_template (calendarid,name,sponsorid,displayedsponsor,displayedsponsorurl,title,wholedayevent,categoryid,description,location,price,contact_name,contact_phone,contact_email,url,recordchangedtime,recordchangeduser) ";
	$query.= "VALUES ('".sqlescape($_SESSION['CALENDAR_ID'])."','".sqlescape($template_name);
	$query.= "','".sqlescape($event['sponsorid'])."','".sqlescape($event['displayedsponsor']);
	$query.= "','".sqlescape($event['displayedsponsorurl'])."','".sqlescape($event['title']);
	$query.= "','".sqlescape($event['wholedayevent'])."','".sqlescape($event['categoryid']);
	$query.= "','".sqlescape($event['description'])."','".sqlescape($event['location']);
	$query.= "','".sqlescape($event['price'])."','".sqlescape($event['contact_name']);
	$query.= "','".sqlescape($event['contact_phone'])."','".sqlescape($event['contact_email']);
	$query.= "','".sqlescape($event['url'])."','".sqlescape($changed)."','".sqlescape($_SESSION["AUTH_USERID"])."')";
	$result =& DBQuery($query);
	if (is_string($result)) return $result;
	
	return true;
}

function updatetemplate($templateid, $template_name, &$event) {
	$changed = date ("Y-m-d H:i:s");
	$query = "UPDATE vtcal_template SET name='".sqlescape($template_name)."',sponsorid='".sqlescape($event['sponsorid']);
	$query.= "',displayedsponsor='".sqlescape($event['displayedsponsor'])."',displayedsponsorurl='".sqlescape($event['displayedsponsorurl']);
	$query.= "',title='".sqlescape($event['title'])."',wholedayevent='".sqlescape($event['wholedayevent']);
	$query.= "',categoryid='".sqlescape($event['categoryid'])."',description='".sqlescape($event['description']);
	$query.= "',location='".sqlescape($event['location'])."',price='".sqlescape($event['price']);
	$query.= "',contact_name='".sqlescape($event['contact_name'])."',contact_phone='".sqlescape($event['contact_phone']);
	$query.= "',contact_email='".sqlescape($event['contact_email'])."',url='".sqlescape($event['url']);
	$query.= "',recordchangedtime='".sqlescape($changed)."',recordchangeduser='".sqlescape($_SESSION["AUTH_USERID"]);
	$query.= "' WHERE sponsorid='".sqlescape($_SESSION["AUTH_SPONSORID"])."' AND id='".sqlescape($templateid)."'";
	$result =& DBQuery($query);
	if (is_string($result)) return $result;
	
	return true; 
}

function insertintorepeat($repeatid, &$event, &$repeat) {
	$repeat['startdate'] = datetime2timestamp($event['timebegin_year'],$event['timebegin_month'],$event['timebegin_day'],0,0,"am");
	$repeat['enddate'] = datetime2timestamp($event['timeend_year'],$event['timeend_month'],$event['timeend_day'],0,0,"am");
	$repeatdef = repeatinput2repeatdef($event,$repeat);
	$changed = date ("Y-m-d H:i:s");

	// write record into repeat table
	$query = "INSERT INTO vtcal_event_repeat (calendarid,id,repeatdef,startdate,enddate,recordchangedtime,recordchangeduser) ";
	$query.= "VALUES ('".sqlescape($_SESSION['CALENDAR_ID'])."','".sqlescape($repeatid)."','".sqlescape($repeatdef)."','".sqlescape($repeat['startdate'])."','".sqlescape($repeat['enddate'])."','".sqlescape($changed)."','".sqlescape($_SESSION["AUTH_USERID"])."')";
	$result =& DBQuery($query);
	if (is_string($result)) return $result;
	
	$repeat['id'] = $repeatid;
	return $repeat['id'];
}

function updaterepeat($repeatid, &$event, &$repeat) {
	$repeat['startdate'] = datetime2timestamp($event['timebegin_year'],$event['timebegin_month'],$event['timebegin_day'],0,0,"am");
	$repeat['enddate'] = datetime2timestamp($event['timeend_year'],$event['timeend_month'],$event['timeend_day'],0,0,"am");
	$repeatdef = repeatinput2repeatdef($event,$repeat);

	// write record into repeat table
	$query = "UPDATE vtcal_event_repeat SET repeatdef='".sqlescape($repeatdef)."',startdate='";
	$query.= sqlescape($repeat['startdate'])."',enddate='".sqlescape($repeat['enddate']);
	$query.= "' WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($repeatid)."'";
	$result =& DBQuery($query);
	if (is_string($result)) return $result;
	
	return $repeatid;
}

// Make a non-repeating event public and remove the old event if a previous version existed.
function publicizeevent($eventid, &$event) {
	// if event delivers repeatid that's fine
	if (!empty($event['repeatid'])) {
		$r['repeatid'] = $event['repeatid'];
	}
	
	// get repeatid from old entry in event_public (important if event changes from recurring to one-time)
	else {
		$result =& DBQuery("SELECT repeatid FROM vtcal_event_public WHERE id='".sqlescape($eventid)."'" );
		if (is_string($result)) return $result;
		
		if ($result->numRows()>0) { 
			$r =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
		}
	}

	if (!empty($r['repeatid'])) { repeatdeletefromevent_public($r['repeatid']); }
	else { deletefromevent_public($eventid); }
	
	// this line should not be necessary but some functions still have a bug that doesn't pass the id in event['id']
	$event['id'] = $eventid;
	
	insertintoevent_public($event);

	$result =& DBQuery("UPDATE vtcal_event SET approved=1 WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'" ); 
	if (is_string($result)) return $result;

	// forward event to default calendar if that's indicated
	if ( $_SESSION['CALENDAR_ID'] != "default" ) {
		// delete existing events in default calendar with same id
		$query = "DELETE FROM vtcal_event WHERE calendarid='default' AND id='".sqlescape($eventid)."'";
		$result =& DBQuery($query );
		if (is_string($result)) return $result;
		
		if ( $event['showondefaultcal'] == 1 ) {
			// add new event in default calendar (with approved=0)
			$eventcategoryid = $event['categoryid'];
			$event['categoryid'] = $event['showincategory'];
			insertintoeventsql("default",$eventid,$event);
			$event['categoryid'] = $eventcategoryid;
		} 
		else {
			$query = "DELETE FROM vtcal_event_public WHERE calendarid='default' AND id='".sqlescape($eventid)."'";
			$result =& DBQuery($query ); 
			if (is_string($result)) return $result;
		}
	}
	
	return true;
} // end: publicizeevent

// Make a repeating event public and remove the old event if a previous version existed.
function repeatpublicizeevent($eventid, &$event) {
	deletefromevent_public($eventid);
	if (!empty($event['repeatid'])) {
		repeatdeletefromevent_public($event['repeatid']);
	}

	// forward events to default calendar: delete old events
	if ( $_SESSION['CALENDAR_ID'] != "default" ) {
		// delete existing events in default calendar with same id
		$e = $eventid;
		$dashpos = strpos($e, "-");
		if ( $dashpos ) { 
			$e = substr($e,0,$dashpos); 
		}
		$query = "DELETE FROM vtcal_event WHERE calendarid='default' AND id='".sqlescape($e)."'";
		$result =& DBQuery($query ); 
		if (is_string($result)) return $result;
		
		if (!empty($event['repeatid'])) {
			$query = "DELETE FROM vtcal_event WHERE calendarid='default' AND repeatid='".sqlescape($event['repeatid'])."'";
			$result =& DBQuery($query ); 
			if (is_string($result)) return $result;
		}
		
		// remove events if checkmark for forwarding is removed
		if ( $event['showondefaultcal'] != 1 ) {
			$query = "DELETE FROM vtcal_event_public WHERE calendarid='default' AND id='".sqlescape($e)."'";
			$result =& DBQuery($query ); 
			if (is_string($result)) return $result;
			
			if (!empty($event['repeatid'])) {
				$query = "DELETE FROM vtcal_event_public WHERE calendarid='default' AND repeatid='".sqlescape($event['repeatid'])."'";
				$result =& DBQuery($query ); 
				if (is_string($result)) return $result;
			}
		}
	}

	// copy all events into event_public
	$result =& DBQuery("SELECT * FROM vtcal_event WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND repeatid='".sqlescape($event['repeatid'])."'" );
	if (is_string($result)) return $result;
	
	for ($i=0;$i<$result->numRows();$i++) {
		$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
//    eventaddslashes($event);
		insertintoevent_public($event);
		
		// forward event to default calendar if that's indicated
		if ( $_SESSION['CALENDAR_ID'] != "default" ) {
			if ( $event['showondefaultcal'] == 1 ) {
				// add new event in default calendar (with approved=0)
				$eventcategoryid = $event['categoryid'];
				$event['categoryid'] = $event['showincategory'];
				insertintoeventsql("default",$event['id'],$event);
				$event['categoryid'] = $eventcategoryid;
			}
		}
	}

	$query = "UPDATE vtcal_event SET approved=1 WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND approved=0 AND repeatid='".sqlescape($event['repeatid'])."'";
	$result =& DBQuery($query ); 
	if (is_string($result)) return $result;
	
	return true;
} // end: repeatpublicizeevent
?>