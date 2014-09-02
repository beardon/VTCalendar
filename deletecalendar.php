<?php
require_once('application.inc.php');

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISMAINADMIN'] ) { exit; } // additional security

	if (!isset($_POST['cancel']) || !setVar($cancel,$_POST['cancel'],'cancel')) unset($cancel);
	if (!isset($_POST['save']) || !setVar($save,$_POST['save'],'save')) unset($save);
	if (isset($_POST['cal']) || isset($_GET['cal'])) {
		if (!isset($_POST['cal']['id']) || !setVar($cal['id'],$_POST['cal']['id'],'calendarid')) {
			if (!isset($_GET['cal']['id']) || !setVar($cal['id'],$_GET['cal']['id'],'calendarid')) unset($cal['id']);
		}
	}
	else {
		unset($cal);
	}


	if (isset($cancel)) {
		redirect2URL("managecalendars.php");
		exit;
	}

	// make sure the calendar exists
	$result =& DBQuery("SELECT * FROM ".SCHEMANAME."vtcal_calendar WHERE id='".sqlescape($cal['id'])."'" );
	if (is_string($result)) { DBErrorBox("Error determining if calendar exists: " . $result); exit; };
	
	if ( $result->numRows() != 1 ) {
		redirect2URL("managecalendars.php");
		exit;
	}
	else {
		$c = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	}

	if (isset($save) ) {
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_event WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error deleting events from ".SCHEMANAME."vtcal_event: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_event_repeat WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error deleting repeating events from ".SCHEMANAME."vtcal_event_repeat: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_event_public WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error deleting public events from ".SCHEMANAME."vtcal_event_public: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_calendarviewauth WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error deleting view auth from ".SCHEMANAME."vtcal_calendarviewauth: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM vtcal_auth WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error deleting auth from vtcal_auth: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_searchlog WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error deleting log entries from ".SCHEMANAME."vtcal_searchlog: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_searchkeyword WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error deleting keywords from ".SCHEMANAME."vtcal_searchkeyword: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_searchfeatured WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error deleting featured keywords from ".SCHEMANAME."vtcal_searchfeatured: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_category WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error categories from ".SCHEMANAME."vtcal_category: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_template WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error templates from ".SCHEMANAME."vtcal_template: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_sponsor WHERE calendarid='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error sponsors from ".SCHEMANAME."vtcal_sponsor: " . $result); exit; };
		
		$result =& DBQuery("DELETE FROM ".SCHEMANAME."vtcal_calendar WHERE id='".sqlescape($cal['id'])."'" );
		if (is_string($result)) { DBErrorBox("Error the calendar from ".SCHEMANAME."vtcal_calendar: " . $result); exit; };
		
		redirect2URL("managecalendars.php");
		exit;
	}

	pageheader(lang('delete_calendar'), "Update");
	contentsection_begin(lang('delete_calendar'));
?>
<b class="WarningText"><?php echo lang('warning_calendar_delete'); ?> &quot;<?php echo $c['name']; ?>&quot;</b>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
	if ( isset ($cal['id']) ) { echo '<input type="hidden" name="cal[id]" value="'.$cal['id'].'">'; }
?>	
	<br>
	<br>
	<input type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
	<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
</form>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>