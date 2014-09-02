<?php
require_once('application.inc.php');

	if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
	if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

	if (isset($cancel)) {
		redirect2URL("viewsearchlog.php");
		exit;
	}

	if (isset($save) ) {
		$result = DBQuery("DELETE FROM vtcal_searchlog WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."'" );
		redirect2URL("viewsearchlog.php");
		exit;
	}

	pageheader(lang('clear_search_log'), "Update");
	contentsection_begin(lang('clear_search_log'));
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<?php echo lang('clear_search_log_confirm'); ?><br>
	<BR>
	<INPUT type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
	<INPUT type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
</form>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>