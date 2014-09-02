<?php
require_once('application.inc.php');
	
	if (!authorized()) { exit; }
	
	if (!($_SESSION['AUTH_LOGINSOURCE'] == "DB")) {
		redirect2URL("update.php");
	}

	if (!isset($_POST['cancel']) || !setVar($cancel,$_POST['cancel'],'cancel')) unset($cancel);
	if (!isset($_POST['save']) || !setVar($save,$_POST['save'],'save')) unset($save);
	if (!isset($_POST['user_oldpassword']) || !setVar($user_oldpassword,$_POST['user_oldpassword'],'password')) unset($user_oldpassword);
	if (!isset($_POST['user_newpassword1']) || !setVar($user_newpassword1,$_POST['user_newpassword1'],'password')) unset($user_newpassword1);
	if (!isset($_POST['user_newpassword2']) || !setVar($user_newpassword2,$_POST['user_newpassword2'],'password')) unset($user_newpassword2);

	if (isset($cancel)) {
		redirect2URL("update.php");
		exit;
	}

	if (isset($save)) {
		$user['oldpassword']=$user_oldpassword;
		$user['newpassword1']=$user_newpassword1;
		$user['newpassword2']=$user_newpassword2;

		$oldpw_error = checkoldpassword($user,$_SESSION["AUTH_USERID"]);
		$newpw_error = checknewpassword($user);
		if ($oldpw_error==0) {
			if ($newpw_error==0) { // new password is valid
				// save password to DB
				$result = DBQuery("UPDATE ".TABLEPREFIX."vtcal_user SET password='".sqlescape(crypt($user['newpassword1']))."' WHERE id='".sqlescape($_SESSION["AUTH_USERID"])."'" ); 

				// reroute to sponsormenu page
				redirect2URL("update.php?fbid=passwordchangesuccess");
				exit;
			}
		}
	}

	pageheader(lang('change_password'), "Update");

	contentsection_begin(lang('change_password'));
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table border="0" cellpadding="2" cellspacing="0">
		<tr>
			<td class="bodytext" valign="top">
				<b><?php echo lang('old_password'); ?></b>
			</td>
			<td class="bodytext" valign="top">
<?php
		if (isset($save) && $oldpw_error) {
			feedback(lang('old_password_wrong'),FEEDBACKNEG);
		}
?>
				<input type="password" name="user_oldpassword" maxlength="20" size="20" value="">
				<i>&nbsp;<?php echo lang('case_sensitive'); ?></i>
			</td>
		</tr>
		<tr>
			<td class="bodytext" valign="top">
				<b><?php echo lang('new_password'); ?></b>
			</td>
			<td class="bodytext" valign="top">
<?php
	if (isset($save)) {
		if ($newpw_error == 1) {
			feedback(lang('two_passwords_dont_match'),FEEDBACKNEG);
		}
		elseif ($newpw_error == 2) {
			feedback(lang('new_password_invalid'),FEEDBACKNEG);
		} // end: if ($newpw_error == 2)
	} // end: if (isset($save))
?>
				<input type="password" name="user_newpassword1" maxlength="20" size="20" value="">
				<i>&nbsp;<?php echo lang('case_sensitive'); ?></i>
			</td>
		</tr>
		<tr>
			<td class="bodytext" valign="top">
				<b><?php echo lang('new_password'); ?></b><br><?php echo lang('password_repeated'); ?>
			</td>
			<td class="bodytext" valign="top">
				<input type="password" name="user_newpassword2" maxlength="20" size="20" value="">
				<i>&nbsp;<?php echo lang('case_sensitive'); ?></i>
			</td>
		</tr>
	</table>
	<br>
	<input type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
	<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
</form>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>