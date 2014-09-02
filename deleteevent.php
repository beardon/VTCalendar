<?php
require_once('application.inc.php');

	if (!isset($_POST['httpreferer']) || !setVar($httpreferer,$_POST['httpreferer'],'httpreferer')) unset($httpreferer);
	if (!isset($_POST['cancel']) || !setVar($cancel,$_POST['cancel'],'cancel')) unset($cancel);
	if (!isset($_POST['check']) || !setVar($check,$_POST['check'],'check')) { 
		if (!isset($_GET['check']) || !setVar($check,$_GET['check'],'check')) unset($check);
	}
	if (!isset($_POST['deleteconfirmed']) || !setVar($deleteconfirmed,$_POST['deleteconfirmed'],'deleteconfirmed')) unset($deleteconfirmed);
	if (!isset($_POST['deletethis']) || !setVar($deletethis,$_POST['deletethis'],'deletethis')) unset($deletethis);
	if (!isset($_POST['deleteall']) || !setVar($deleteall,$_POST['deleteall'],'deleteall')) unset($deleteall);
	if (!isset($_POST['eventid']) || !setVar($eventid,$_POST['eventid'],'eventid')) { 
		if (!isset($_GET['eventid']) || !setVar($eventid,$_GET['eventid'],'eventid')) unset($eventid);
	}

	if (!authorized()) { exit; }

	if (!isset($httpreferer)) {
		if (empty($_SERVER["HTTP_REFERER"])) {
			$httpreferer = "update.php";
		}
		else {
			$httpreferer = $_SERVER["HTTP_REFERER"];
		}
	}

	// check that the event exists.
	$query = "SELECT sponsorid FROM ".TABLEPREFIX."vtcal_event WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'";
	$result = DBQuery($query );
	if ($result->numRows() > 0) { 
			$e = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	}
	else {
		$query = "SELECT * FROM ".TABLEPREFIX."vtcal_event_public WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'";
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
	
	// Check that the user is an admin or the sponsor for the event to be deleted.
	if (!(
			!empty($_SESSION['AUTH_ISCALENDARADMIN']) ||
			(isset($_SESSION["AUTH_SPONSORID"]) && $_SESSION["AUTH_SPONSORID"] == $e['sponsorid'])
		 )) {
	 redirect2URL($httpreferer);
	 exit;
	}

	if (isset($cancel)) {
		redirect2URL($httpreferer);
		exit;
	};

	
	if (isset($deleteconfirmed)) {
		// get the event title from the database
		$result = DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_event WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($eventid)."'" ); 
		if ($result->numRows() > 0) { $event  = $result->fetchRow(DB_FETCHMODE_ASSOC,0); }
		else { $event['title']=""; }

		deletefromevent($eventid);
		deletefromevent_public($eventid);
		
		// also delete the copies of an event that have been forwarded to the default calendar
		if ( $_SESSION['CALENDAR_ID'] != "default" ) {
			$query = "DELETE FROM ".TABLEPREFIX."vtcal_event_public WHERE calendarid='default' AND id='".sqlescape($eventid)."'";
			$result = DBQuery($query ); 
		} // end: if ( $_SESSION['CALENDAR_ID'] != "default" )
		
		if (isset($deleteall)) {
			repeatdeletefromevent($event['repeatid']);
			repeatdeletefromevent_public($event['repeatid']);
			deletefromrepeat($event['repeatid']);

			// also delete the copies of an event that have been forwarded to the default calendar
			if ( $_SESSION['CALENDAR_ID'] != "default" ) {
				if (!empty($event['repeatid'])) {
					$query = "DELETE FROM ".TABLEPREFIX."vtcal_event_public WHERE calendarid='default' AND repeatid='".sqlescape($event['repeatid'])."'";
					$result = DBQuery($query ); 
				}
			} // end: if ( $_SESSION['CALENDAR_ID'] != "default" )
		} // end: elseif (isset($deleteall))

		// reroute
		if (strpos($httpreferer,"update.php")) {
			redirect2URL("update.php?fbid=edeletesuccess&fbparam=".urlencode(stripslashes($event['title'])));
		}
		else {
			redirect2URL($httpreferer);
		}
		exit;
	}

	// read sponsor name from DB
	$result = DBQuery("SELECT name,url FROM ".TABLEPREFIX."vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($_SESSION["AUTH_SPONSORID"])."'" ); 
	$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);

	pageheader(lang('delete_event'), "Update");
	contentsection_begin(lang('delete_event'));
?>
<form method="post" action="deleteevent.php">
<?php
		echo '<input type="hidden" name="httpreferer" value="',$httpreferer,'">',"\n";

		if (isset($check)) { // ask for delete confirmation
			$query = "SELECT e.id AS eventid,e.timebegin,e.timeend,e.sponsorid,e.title,e.location,e.description,e.contact_name,e.contact_email,e.contact_phone,e.price,e.displayedsponsor,e.displayedsponsorurl,e.wholedayevent,e.repeatid,e.categoryid,c.id,c.name AS category_name FROM ".TABLEPREFIX."vtcal_event e, ".TABLEPREFIX."vtcal_category c WHERE e.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND c.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND e.categoryid = c.id AND e.id='".sqlescape($eventid)."'";
			$result = DBQuery($query );

			if ($result->numRows() > 0) { // display the preview only if there is a corresponding entry in "event"
				$event = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	
				if (!empty($event['repeatid'])) {
					readinrepeat($event['repeatid'],$event,$repeat);
				}
				else { $repeat['mode'] = 0; }
				disassemble_timestamp($event);

				print_event($event);  
?>
		<br>
<?php
		if (!empty($event['repeatid'])) {
			echo '<span class="NotificationText">';
			readinrepeat($event['repeatid'],$event,$repeat);
			$repeatdef = repeatinput2repeatdef($event,$repeat);
			printrecurrence($event['timebegin_year'],
				$event['timebegin_month'],
				$event['timebegin_day'],
				$repeatdef);
			echo '</span>';
		}
	} // end: if (numRows() > 0)
	else {
		$repeat['mode'] = 0;
	}
?>
	<br>
	<br>
	<b><?php echo lang('delete_event_confirm'); ?></b>
	<br>
	<br>
	<input type="hidden" name="eventid" value="<?php echo $eventid; ?>">
	<input type="hidden" name="deleteconfirmed" value="1">
	<input type="submit" name="deletethis" value="<?php echo lang('button_delete_this_event'); ?>">
<?php
	if ($repeat['mode'] > 0) {
		echo '&nbsp;<input type="submit" name="deleteall" value="',lang('button_delete_all_recurrences'),'">';
	}

		} // end: if (isset($check))
?>
	&nbsp;
	<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
	<br>
</form>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>