<?php
require_once('application.inc.php');

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISMAINADMIN']) { exit; } // additional security

	if (!isset($_POST['cancel']) || !setVar($cancel,$_POST['cancel'],'cancel')) unset($cancel);
	if (!isset($_POST['save']) || !setVar($save,$_POST['save'],'save')) unset($save);
	if (!isset($_POST['check']) || !setVar($check,$_POST['check'],'check')) unset($check);
	if (!isset($_POST['deleteconfirmed']) || !setVar($deleteconfirmed,$_POST['deleteconfirmed'],'deleteconfirmed')) unset($deleteconfirmed);
	if (!isset($_POST['mainuserid']) || !setVar($mainuserid,$_POST['mainuserid'],'userid')) {   
		if (!isset($_GET['mainuserid']) || !setVar($mainuserid,$_GET['mainuserid'],'userid')) unset($mainuserid);
	}

	if (isset($cancel)) {
		redirect2URL("managemainadmins.php");
		exit;
	}

	if (isset($deleteconfirmed)) {
		// get the user from the database
		$result = DBQuery("DELETE FROM ".SCHEMANAME."vtcal_adminuser WHERE id='".sqlescape($mainuserid)."'" );
		redirect2URL("managemainadmins.php");
		exit;
	}
	elseif (isset($check) && empty($mainuserid)) {
		// reroute to sponsormenu page
		redirect2URL("update.php?fbid=userdeletefailed");
		exit;
	}

	// print page header
	pageheader(lang('delete_main_admin'), "");
	contentsection_begin(lang('delete_main_admin'));
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<b><?php echo lang('delete_main_admin_confirm'); ?> &quot;<?php echo $mainuserid; ?>&quot;</b>
	<br>
	<br>
	<input type="hidden" name="mainuserid" value="<?php echo $mainuserid; ?>">
	<input type="hidden" name="deleteconfirmed" value="1">
	<input type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
	<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
	<br>
</form>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>