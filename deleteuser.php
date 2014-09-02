<?php
require_once('application.inc.php');

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

	if (!isset($_POST['cancel']) || !setVar($cancel,$_POST['cancel'],'cancel')) unset($cancel);
	if (!isset($_POST['deleteuser']) || !setVar($deleteuser,$_POST['deleteuser'],'deleteuser')) unset($deleteuser);
	if (!isset($_POST['deleteconfirmed']) || !setVar($deleteconfirmed,$_POST['deleteconfirmed'],'deleteconfirmed')) unset($deleteconfirmed);
	if (!isset($_POST['userid']) || !setVar($userid,$_POST['userid'],'userid')) { 
		if (!isset($_GET['userid']) || !setVar($userid,$_GET['userid'],'userid')) unset($userid);
	}

	if (isset($cancel)) {
		redirect2URL("manageusers.php");
		exit;
	}

	if (isset($deleteconfirmed)) {
		// get the user from the database
		$result = DBQuery("DELETE FROM ".TABLEPREFIX."vtcal_user WHERE id='".sqlescape($userid)."'" );
		$result = DBQuery("DELETE FROM vtcal_auth WHERE userid='".sqlescape($userid)."'" );

		redirect2URL("manageusers.php");
		exit;
	}
	elseif (isset($check) && empty($userid)) {
		// reroute to sponsormenu page
		redirect2URL("update.php?fbid=userdeletefailed");
		exit;
	}

	// print page header
	pageheader(lang('delete_user'), "Update");
	contentsection_begin(lang('delete_user'));
?>
<form method="post" action="deleteuser.php">
	<b><?php echo lang('delete_user_confirm'); ?> &quot;<?php echo $userid; ?>&quot;</b>
	<br>
	<br>
	<input type="hidden" name="userid" value="<?php echo $userid; ?>">
	<input type="hidden" name="deleteconfirmed" value="1">
	<input type="submit" name="deleteuser" value="<?php echo lang('ok_button_text'); ?>">
	&nbsp;
	<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
	<br>
</form>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>