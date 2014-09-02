<?php
require_once('application.inc.php');

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISMAINADMIN']) { exit; } // additional security

	if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
	if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
	if (isset($_POST['check'])) { setVar($check,$_POST['check'],'check'); } else { unset($check); }
	if (isset($_POST['deleteconfirmed'])) { setVar($deleteconfirmed,$_POST['deleteconfirmed'],'deleteconfirmed'); } else { unset($deleteconfirmed); }
	if (isset($_POST['mainuserid'])) { setVar($mainuserid,$_POST['mainuserid'],'userid'); } 
	else {   
		if (isset($_GET['mainuserid'])) { setVar($mainuserid,$_GET['mainuserid'],'userid'); } else { unset($mainuserid); }
	}

	if (isset($cancel)) {
		redirect2URL("managemainadmins.php");
		exit;
	}

	if (isset($deleteconfirmed)) {
		// get the user from the database
		$result = DBQuery("DELETE FROM vtcal_adminuser WHERE id='".sqlescape($mainuserid)."'" );
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
<FORM method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<B><?php echo lang('delete_main_admin_confirm'); ?> &quot;<?php echo $mainuserid; ?>&quot;</B>
	<BR>
	<BR>
	<INPUT type="hidden" name="mainuserid" value="<?php echo $mainuserid; ?>">
	<INPUT type="hidden" name="deleteconfirmed" value="1">
	<INPUT type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
	<INPUT type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
	<BR>
</FORM>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>