<?php
require_once('application.inc.php');

if (!authorized()) { exit; }
if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
if (isset($_POST['users'])) { setVar($users,$_POST['users'],'users'); } else { unset($users); }
if (isset($_POST['title'])) { setVar($title,$_POST['title'],'calendarTitle'); } else { unset($title); }
if (isset($_POST['header'])) { setVar($header,$_POST['header'],'calendarHeader'); } else { unset($header); }
if (isset($_POST['footer'])) { setVar($footer,$_POST['footer'],'calendarFooter'); } else { unset($footer); }
if (isset($_POST['viewauthrequired'])) { setVar($viewauthrequired,$_POST['viewauthrequired'],'viewauthrequired'); } else { unset($viewauthrequired); }
if (isset($_POST['forwardeventdefault'])) { setVar($forwardeventdefault,$_POST['forwardeventdefault'],'forwardeventdefault'); } else { unset($forwardeventdefault); }
	 
if (isset($cancel)) {
redirect2URL("update.php");
exit;
};

// Re-read the settings from the DB if one of the required fields was not set.
if (!(isset($title) && isset($header) && isset($footer) && isset($viewauthrequired))) {
	$title = $_SESSION['CALENDAR_TITLE'];	
	$header = $_SESSION['CALENDAR_HEADER'];	
	$footer = $_SESSION['CALENDAR_FOOTER'];	
	$viewauthrequired	= $_SESSION['CALENDAR_VIEWAUTHREQUIRED'];
	$forwardeventdefault = $_SESSION['CALENDAR_FORWARD_EVENT_BY_DEFAULT'];		
}

$addPIDError="";
if ( isset($save) ) {
	// check validity of users
	if ( !empty($users) ) {
		// disassemble the users string and check all PIDs against the DB
		$pidsInvalid = "";
		$pidsTokens = split ( "[ ,;\n\t]", $users );
		$pidsAddedCount = 0;
		$pidsAdded = array();
		for ($i=0; $i<count($pidsTokens); $i++) {
			$pidName = $pidsTokens[$i];
			$pidName = trim($pidName);
			if ( !empty($pidName) ) {
				if ( isValidUser ( $pidName ) ) {
					$pidsAdded[$pidsAddedCount] = $pidName;
					$pidsAddedCount++;
				} 
				else {
					if ( !empty($pidsInvalid) ) { $pidsInvalid .= ","; }
					$pidsInvalid .= $pidName;
				}
			} 
		} // end: while

		// feedback message(s)
		if ( !empty($pidsInvalid) ) {
			if ( strpos($pidsInvalid, "," ) > 0 ) { // more than one user-ID
				$addPIDError = lang('user_ids_invalid')." &quot;".$pidsInvalid."&quot;";
			}
			else {
				$addPIDError = lang('user_id_invalid')." &quot;".$pidsInvalid."&quot;";
			}
		}
	} // end: else: if ( empty($users) )
	
	if (empty($addPIDError)) { 
		// save the settings to database
		if ( $viewauthrequired != 0 ) { $viewauthrequired = 1; }
		if ( !isset($forwardeventdefault) || $forwardeventdefault != "1" ) { $forwardeventdefault = "0"; }
		$result =& DBQuery("UPDATE vtcal_calendar SET title='".sqlescape($title)."',header='".sqlescape($header)."',footer='".sqlescape($footer)."',"
			. "viewauthrequired='".sqlescape($viewauthrequired)."',forwardeventdefault='".sqlescape($forwardeventdefault)."'"
			. " WHERE id='".sqlescape($_SESSION['CALENDAR_ID'])."'" ); 
		
		if (is_string($result)) { DBErrorBox($result); exit; }
		
		// substitute existing auth info with the new one
		$result =& DBQuery("DELETE FROM vtcal_calendarviewauth WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."'" );
		if (is_string($result)) { DBErrorBox($result); exit; }
		
		for ($i=0; $i<$pidsAddedCount; $i++) {
			$result =& DBQuery("INSERT INTO vtcal_calendarviewauth (calendarid,userid) VALUES ('".sqlescape($_SESSION['CALENDAR_ID'])."','".sqlescape($pidsAdded[$i])."')" );
			if (is_string($result)) { DBErrorBox($result); exit; }
		}
		
		setCalendarPreferences();
		
		redirect2URL("update.php");
		exit;
	}
}

// read sponsor name from DB
$result =& DBQuery("SELECT name FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($_SESSION["AUTH_SPONSORID"])."'" ); 
if (is_string($result)) { DBErrorBox($result); exit; }
$sponsor =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);

pageheader(lang('change_header_footer_auth'), "Update");
contentsection_begin(lang('change_header_footer_auth'));
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="globalSettings">

<p><input type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>" class="button">&nbsp;&nbsp;<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>" class="button"></p>

	<b><?php echo lang('calendar_title'); ?>:</b> <font color="#999999"><?php echo lang('empty_or_any_text'); ?></font><br>
	<input type="text" name="title" maxlength="<?php echo $constCalendarTitleMAXLENGTH; ?>" size="30" value="<?php 
	echo htmlentities($title);
	?>"><br>
	<br>

	<b><?php echo lang('header_html'); ?>:</b> <font color="#999999"><?php echo lang('empty_or_any_html'); ?></font><br>
	<textarea name="header" wrap="physical" cols="70" rows="10" style="width: 100%;"><?php 
	echo htmlentities($header);
	?></textarea><br>
	<br>

	<b><?php echo lang('footer_html'); ?>:</b> <font color="#999999"><?php echo lang('empty_or_any_html'); ?></font><br>
	<textarea name="footer" wrap="physical" cols="70" rows="10" style="width: 100%;"><?php
	echo htmlentities($footer);
	?></textarea><?php

if ( $_SESSION['CALENDAR_ID'] != "default" ) {
	$result =& DBQuery("SELECT * FROM vtcal_calendar WHERE id='default'" ); 
	if (is_string($result)) {
		DBErrorBox($result);
	}
	else {
		$c =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
		$defaultcalendarname = $c['name'];
		?><br>
		<table border="0">
			<tr align="left" valign="top">
				<td><input type="checkbox" name="forwardeventdefault" id="forwardeventdefault" value="1"<?php if ($forwardeventdefault=="1") { echo " checked"; } ?>></td>
				<td><strong><label for="forwardeventdefault">By default also display events on the <?php echo $defaultcalendarname ?></label></strong> <br>
					(Sponsors can still disable this on a per-event basis)</td>
			</tr>
		</table><?php
	}
}
?>
 <br>
<br>

		<b><?php echo lang('login_required_for_viewing'); ?></b>
</p>
<table border="0" cellpadding="3" cellspacing="3">
<tr>
	<td align="right"><input type="radio" name="viewauthrequired" value="0"<?php 
	if ( $viewauthrequired == 0 ) { echo " checked"; }
	?>></td>
	<td align="left"><?php echo lang('no_login_required'); ?><br></td>
</tr>
<tr>
	<td align="right" valign="top"><input type="radio" name="viewauthrequired" value="1"<?php 
	if ( $viewauthrequired != 0 ) { echo " checked"; }
	?>></td>
	<td align="left"><?php echo lang('login_required_user_ids'); ?>:<br>
<?php
	if (!empty($addPIDError)) {    
		feedback($addPIDError,1);
	}

	if ( isset($users) ) {
		echo $users;
	}
	else {
		$query = "SELECT * FROM vtcal_calendarviewauth WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' ORDER BY userid";
		$result =& DBQuery($query ); 
		if (is_string($result)) {
			DBErrorBox($result);
		}
		else {
			?><textarea name="users" cols="40" rows="6" wrap="virtual"><?php
			$i = 0;
			while ($i < $result->numRows()) {
				$viewauth =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
				if ($i>0) { echo ","; }
				echo $viewauth['userid'];
				$i++;
			}
			?></textarea><br><?php
		}
	}
		
		?><i><?php echo lang('separate_user_ids_with_comma'); ?></i>
	</td>
</tr>
</table>
<p><input type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>" class="button">&nbsp;&nbsp;<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>" class="button"></p>
</form>
<?php 
	contentsection_end();
	pagefooter();
DBclose();
?>