<?php
require_once('application.inc.php');

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISMAINADMIN'] ) { exit; } // additional security

	if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
	if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
	if (isset($_POST['cal']) && isset($_POST['cal']['id'])) { setVar($cal['id'],$_POST['cal']['id'],'calendarid'); }
	elseif (isset($_GET['cal']) && isset($_GET['cal']['id'])) { setVar($cal['id'],$_GET['cal']['id'],'calendarid'); } 
	else { unset($cal); }


	if (isset($cancel)) {
		redirect2URL("managecalendars.php");
		exit;
	}

	// make sure the calendar exists
	$result = DBQuery("SELECT * FROM vtcal_calendar WHERE id='".sqlescape($cal['id'])."'" );
	if ( $result->numRows() != 1 ) {
		redirect2URL("managecalendars.php");
		exit;
	}
	else {
		$c = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	}

	if (isset($save) ) {
		$result = DBQuery("DELETE FROM vtcal_event WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_event_repeat WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_event_public WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_calendarviewauth WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_auth WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_searchlog WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_searchkeyword WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_searchfeatured WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_category WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_template WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_sponsor WHERE calendarid='".sqlescape($cal['id'])."'" );
		$result = DBQuery("DELETE FROM vtcal_calendar WHERE id='".sqlescape($cal['id'])."'" );
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
	<BR>
	<BR>
	<INPUT type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
	<INPUT type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
</form>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>