<?php
require_once('application.inc.php');

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

	if (!isset($_POST['cancel']) || !setVar($cancel,$_POST['cancel'],'cancel')) unset($cancel);
	if (!isset($_POST['save']) || !setVar($save,$_POST['save'],'save')) unset($save);
	if (!isset($_POST['check']) || !setVar($check,$_POST['check'],'check')) unset($check);
	if (!isset($_POST['keyword']) || !setVar($keyword,$_POST['keyword'],'keyword')) unset($keyword);
	if (!isset($_POST['alternativekeyword']) || !setVar($alternativekeyword,$_POST['alternativekeyword'],'keyword')) unset($alternativekeyword);

	if (isset($cancel)) {
		redirect2URL("managesearchkeywords.php");
		exit;
	}

	if (isset($save) && !empty($keyword) && !empty($alternativekeyword) ) {
		$result =& DBQuery("INSERT INTO ".TABLEPREFIX."vtcal_searchkeyword (calendarid,keyword,alternative) VALUES ('".sqlescape($_SESSION['CALENDAR_ID'])."','".sqlescape(strtolower($keyword))."','".sqlescape(strtolower($alternativekeyword))."')" );
		if (is_string($result)) {
				DBErrorBox($result); exit;
		}
		else {
			redirect2URL("managesearchkeywords.php");
			exit;
		}
	}

	pageheader(lang('add_new_keyword_pair'), "Update");
	contentsection_begin(lang('add_new_keyword_pair'));
?>
<br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<?php echo lang('add_new_keyword_pair_instructions'); ?>
	<br>
	<table cellpadding="3" cellspacing="3" border="0">
		<tr>
			<td><b><?php echo lang('keyword'); ?>:</b>
<?php
	if ( isset($check) ) {
		if ( empty($keyword) ) {
			feedback("<br>".lang('keyword_cannot_be_empty'),1);
		} 
	}
?>
			</td>
			<td><b><?php echo lang('alternative_keyword'); ?></b>
<?php
	if ( isset($check) ) {
		if ( empty($alternativekeyword) ) {
			feedback("<br>".lang('keyword_cannot_be_empty'),1);
		} 
	}
?>
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" name="keyword" maxlength="<?php echo MAXLENGTH_KEYWORD; ?>" size="20" value="<?php 
				if (!empty($keyword)) { echo HTMLSpecialChars($keyword); }
				?>">
			</td>
			<td>
				<input type="text" name="alternativekeyword" maxlength="<?php echo MAXLENGTH_KEYWORD; ?>" size="20" value="<?php 
				if (!empty($alternativekeyword)) { echo HTMLSpecialChars($alternativekeyword); } 
				?>">
			</td>
		</tr>
	</table>
	<input type="hidden" name="check" value="1"><br>
	<input type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
	<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
</form>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>
