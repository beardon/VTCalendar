<?php
require_once('application.inc.php');

	if (!authorized()) { exit; }

	if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
	if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
	if (isset($_POST['sponsor_url'])) { setVar($sponsor_url,$_POST['sponsor_url'],'sponsor_url'); } else { unset($sponsor_url); }

	if (isset($cancel)) {
		redirect2URL("update.php");
		exit;
	}

	// read sponsor name from DB
	$result = DBQuery("SELECT name FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($_SESSION["AUTH_SPONSORID"])."'" ); 
	$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);

	if (isset($save)) {
		$sponsor['url']=$sponsor_url;
		if (checkURL($sponsor['url'])) { // url is valid
			// save url to DB
			$result = DBQuery("UPDATE vtcal_sponsor SET url='".sqlescape($sponsor_url)."' WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($_SESSION["AUTH_SPONSORID"])."'" ); 

			// reroute to sponsormenu page
			redirect2URL("update.php?fbid=urlchangesuccess&fbparam=".urlencode(stripslashes($sponsor_url)));
			exit;
		}
	}
	else
	{ // read the sponsor's url from the DB
		$result = DBQuery("SELECT * FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($_SESSION["AUTH_SPONSORID"])."'" ); 
		$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	} // end else: if (isset($save))
	

	pageheader(lang('change_homepage'), "Update");
	contentsection_begin(lang('change_homepage'));
?>
<p><B><?php echo lang('change_homepage_label'); ?></B><BR>
<I><?php echo lang('change_homepage_example'); ?></I></p>
<FORM method="post" action="changehomepage.php">
<?php
	if (!checkURL($sponsor['url'])) {
		feedback(lang('url_invalid'),FEEDBACKNEG);
?>
	<BR>
<?php
	} /* end: if ($checkURL($sponsor[url])) */
?>
	<INPUT type="text" name="sponsor_url" maxlength="<?php echo constUrlMaxLength; ?>" size="60" value="<?php echo HTMLSpecialChars($sponsor['url']); ?>">
	<BR>
	<BR>
	<INPUT type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
	<INPUT type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
</FORM>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>