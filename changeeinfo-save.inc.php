<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

// ================================
// Save event into DB
// ================================

// Assign a begin/end timestamp (YYYY-MM-DD HH:MM:SS AMPM)
assemble_timestamp($event);

// Make a list containing all the resulting dates (in case there are any)
unset($repeatlist);
if ($repeat['mode']>=1 && $repeat['mode']<=2) { $repeatlist = producerepeatlist($event,$repeat); }

// Update an existing event (not a copy)
if (isset($eventid) && (!isset($copy) || $copy != 1)) {

	// Before the event was non-reoccurring
	if (empty($event['repeatid'])) {
	
		// If the event is now reoccurring
		if (isset($repeatlist) && sizeof($repeatlist) > 0) {
			
			// Delete the old single event
			deletefromevent($eventid);

			// Insert recurrences
			$event['repeatid'] = $eventid; // = getNewEventId();
			insertintorepeat($event['repeatid'],$event,$repeat);
			insertrecurrences($event['repeatid'],$event,$repeatlist);
		}
		
		// Otherwise, the event is still non-reoccurring.
		else {
		
			// Delete the event if is a recurring event but has no real recurrences
			if ($repeat['mode']>=1 && $repeat['mode']<=2) {
				deletefromevent($eventid);
			}
			
			// Otherwise, update the event in the DB
			else {
				$event['repeatid']="";
				updateevent($eventid, $event);
			}
		}
	}
	
	// Before the event was reoccurring
	else {
		
		// The event still has recurrences
		if (!empty($repeatlist)) {
		
	 	  // Delete the old events
			repeatdeletefromevent($event['repeatid']);

			// Insert the new recurrences
			updaterepeat($event['repeatid'],$event,$repeat);
			insertrecurrences($event['repeatid'],$event,$repeatlist);
		}
		
		// The event is now non-reoccurring.
		else {
		
			// Delete the event if it is a recurring event but has no real recurrences
			// TODO: When does this apply?
			if ($repeat['mode']>=1 && $repeat['mode']<=2) {
				repeatdeletefromevent($event['repeatid']);
				deletefromrepeat($event['repeatid']);
	 	  }
	 	  
			// Change the event to a non-reoccurring event.
			else {
				deletefromrepeat($event['repeatid']);
	 	    $oldrepeatid=$event['repeatid'];
				$eventid=$event['repeatid']; // added to avoid "...-0001" in eventid if it's not repeating
				$event['repeatid']="";
				insertintoevent($eventid,$event);
				
				// Delete all old recurring events but one
				repeatdeletefromevent($oldrepeatid);
				repeatdeletefromevent_public($oldrepeatid);
			}
		}
	}

	// Whatever the "admin" edits gets approved right away
	if ($_SESSION['AUTH_ISCALENDARADMIN']) {
		if (!empty($event['repeatid'])) {
			repeatpublicizeevent($eventid,$event);
		}
		else {
			publicizeevent($eventid,$event);
		}
	}

	// Redirect the user back to the previous page.
	if (strpos($httpreferer,"update.php")) {
		redirect2URL("update.php?fbid=eupdatesuccess&fbparam=".urlencode($event['title']));
		exit;    
	}
	else {
		$target = $httpreferer;
		redirect2URL($target);
		exit;
	}
}

// Insert as a new event or copy of an existing event
else {
	// Event is re-ocurring.
	if (isset($repeatlist) && sizeof($repeatlist) > 0) {
	
		// Create the new event ID.
		$event['repeatid'] = getNewEventId();
		
		// Insert in the DB.
		insertintorepeat($event['repeatid'],$event,$repeat);
		insertrecurrences($event['repeatid'],$event,$repeatlist);
		$eventid = "";
	}
	
	// Event is not re-ocurring.
	else {
		$event['repeatid'] = "";
		
		// Create the new event ID.
		$eventid = getNewEventId();
		
		
		// Insert into the DB.
		insertintoevent($eventid,$event);
	}
	
	$event['id'] = $eventid;

	// Whatever the "admin" edits gets approved right away
	if ($_SESSION['AUTH_ISCALENDARADMIN']) {
		if (!empty($event['repeatid'])) { repeatpublicizeevent($eventid,$event); }
		else { publicizeevent($eventid,$event); }
	}

	// Redirect the user back to the previous page.
	if (strpos($httpreferer,"update.php")) {
		redirect2URL("update.php?fbid=eaddsuccess&fbparam=".urlencode($event['title']));
		exit;
	}
	else {
		$target = $httpreferer;
		redirect2URL($target);
		exit;
	}
}

function insertrecurrences($repeatid,&$event,&$repeatlist) {
	$i = 0;
	while ($dateJD = each($repeatlist)) {
		$i++;
		$date = Decode_Date_US(JDToJulian($dateJD['value']));
		$event['timebegin_month'] = $date['month'];
		$event['timebegin_day']   = $date['day'];
		$event['timebegin_year']  = $date['year'];
		$event['timeend_month'] = $date['month'];
		$event['timeend_day']   = $date['day'];
		$event['timeend_year']  = $date['year'];
		assemble_timestamp($event);

		// insert event
		$eventidext = "";
		if ($i<1000) {
			if ($i<100) {
				if ($i<10) { 
					$eventidext .= "0"; 
				}
				$eventidext .= "0";
			}
			$eventidext .= "0";
		}
		$eventidext .= $i;

		insertintoevent($repeatid."-".$eventidext,$event);
	} // end: while ($dateJD = each($repeatlist))
} // end: function insertrecurrences
?>