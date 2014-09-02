<?php
require_once('application.inc.php');

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

	if (!isset($_POST['cancel']) || !setVar($cancel,$_POST['cancel'],'cancel')) unset($cancel);
	if (!isset($_POST['save']) || !setVar($save,$_POST['save'],'save')) unset($save);
	if (!isset($_POST['check']) || !setVar($check,$_POST['check'],'check')) unset($check);
	if (!isset($_POST['id']) || !setVar($id,$_POST['id'],'sponsorid')) { 
		if (!isset($_GET['id']) || !setVar($id,$_GET['id'],'sponsorid')) unset($id);
	}
	if (isset($_POST['sponsor'])) { 
		if (!isset($_POST['sponsor']['name']) || !setVar($sponsor['name'],$_POST['sponsor']['name'],'sponsor_name')) unset($sponsor['name']);
		if (!isset($_POST['sponsor']['email']) || !setVar($sponsor['email'],$_POST['sponsor']['email'],'email')) unset($sponsor['email']);
		if (!isset($_POST['sponsor']['url']) || !setVar($sponsor['url'],$_POST['sponsor']['url'],'sponsor_url')) $sponsor['url'] = '';
		if (!isset($_POST['sponsor']['admins']) || !setVar($sponsor['admins'],$_POST['sponsor']['admins'],'sponsor_admins')) $sponsor['admins'] = '';
	}
	else {
		unset($sponsor);
	}

	if (isset($cancel)) {
		redirect2URL("managesponsors.php");
		exit;
	}

	function checksponsor(&$sponsor) {
		return (!empty($sponsor['name']) &&
			 	    !empty($sponsor['email']) &&
						(empty($sponsor['url']) || checkURL($sponsor['url'])));
	}

	function emailsponsoraccountchanged(&$sponsor) {
		$subject = lang('email_account_updated_subject');
		$body = lang('email_account_updated_body');
		$body .= "   ".lang('sponsor_name')." ".stripslashes($sponsor['name'])."\n";
		$body .= "   ".lang('email').": ".stripslashes($sponsor['email'])."\n";
		$body .= "   ".lang('homepage').": ".stripslashes($sponsor['url'])."\n\n";
		$body .= SECUREBASEURL."update.php?calendarid=".$_SESSION['CALENDAR_ID']."\n\n";
		$body .= lang('email_add_event_instructions');
		sendemail2sponsor($sponsor['name'],$sponsor['email'],$subject,$body);
	} // end: emailsponsoraccountchanged

	$sponsorexists = false;
	$addPIDError="";
	$pidsAdded = array();
	if (isset($save) && checksponsor($sponsor) ) {
		$result = DBQuery("SELECT * FROM ".SCHEMANAME."vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND name='".sqlescape($sponsor['name'])."'" );
		if ( $result->numRows()>0 ) {
			if ($result->numRows()>1) {
				$sponsorexists = true;
			}
			else { // exactly one result
				if ( isset ($id) ) {
					$s = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
					if ( $s['id'] != $id ) {
						$sponsorexists = true;
					}
				}
				else {
					$sponsorexists = true;
				}			
			}
		}

		if (!$sponsorexists) {
			// check validity of sponsor-admins
			if ( !empty($sponsor['admins']) ) {
				// disassemble the admins string and check all PIDs against the DB
				$pidsInvalid = "";
				$pidsTokens = split ( "[ ,;\n\t]", $sponsor['admins'] );
				$pidsAddedCount = 0;
				for ($i=0; $i<count($pidsTokens); $i++) {
					$pidName = $pidsTokens[$i];
					$pidName = trim($pidName);
					if ( !empty($pidName) ) {
						if ( isvaliduser ( $pidName ) ) {
							$pidsAdded[$pidsAddedCount] = $pidName;
							$pidsAddedCount++;
						} 
						else {
							if ( !empty($pidsInvalid) ) { $pidsInvalid .= ","; }
							$pidsInvalid .= $pidName;
						}
					} 
				} // end: while
		
				// save the changes
		
				// feedback message(s)
				if ( !empty($pidsInvalid) ) {
					if ( strpos($pidsInvalid, "," ) > 0 ) { // more than one user-ID
						$addPIDError = lang('user_ids_invalid')." &quot;".$pidsInvalid."&quot;";
					}
					else {
						$addPIDError = lang('user_id_invalid')." &quot;".$pidsInvalid."&quot;";
					}
				}
			} // end: else: if ( empty($sponsor[admins]) )

			if (empty($addPIDError)) {    
				if ( isset ($id) ) { // edit, not new
					$result = DBQuery("UPDATE ".SCHEMANAME."vtcal_sponsor SET name='".sqlescape($sponsor['name'])."',email='".sqlescape($sponsor['email'])."',url='".sqlescape($sponsor['url'])."' WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id = '".sqlescape($id)."'" );
	
					// substitute existing auth info with the new one
					$result = DBQuery("DELETE FROM ".SCHEMANAME."vtcal_auth WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND sponsorid='".sqlescape($id)."'" );
					for ($i=0; $i<count($pidsAdded); $i++) {
						$result = DBQuery("INSERT INTO ".SCHEMANAME."vtcal_auth (calendarid,userid,sponsorid) VALUES ('".sqlescape($_SESSION['CALENDAR_ID'])."','".sqlescape($pidsAdded[$i])."','".sqlescape($id)."')" );
					}
				}
				else {
					$query = "INSERT INTO ".SCHEMANAME."vtcal_sponsor (calendarid,name,email,url) VALUES ('".sqlescape($_SESSION['CALENDAR_ID'])."','".sqlescape($sponsor['name'])."','".sqlescape($sponsor['email'])."','".sqlescape($sponsor['url'])."')";
					$result = DBQuery($query ); 
	
					// determine the automatically generated sponsor-id
					$result = DBQuery("SELECT id FROM ".SCHEMANAME."vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND name='".sqlescape($sponsor['name'])."' AND email='".sqlescape($sponsor['email'])."' AND url='".sqlescape($sponsor['url'])."'" ); 
					$s = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
					$id = $s['id'];
					
					// substitute existing auth info with the new one
					$result = DBQuery("DELETE FROM ".SCHEMANAME."vtcal_auth WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND sponsorid='".sqlescape($id)."'" );
					for ($i=0; $i<count($pidsAdded); $i++) {
						$result = DBQuery("INSERT INTO ".SCHEMANAME."vtcal_auth (calendarid,userid,sponsorid) VALUES ('".sqlescape($_SESSION['CALENDAR_ID'])."','".sqlescape($pidsAdded[$i])."','".sqlescape($id)."')" );
					}
				}
									
				emailsponsoraccountchanged($sponsor);
				redirect2URL("managesponsors.php");
				exit;
			} // end: if (empty($addPIDError))
		} // end: if (!$sponsorexists) 
	}

	if ( isset($id) ) {
		pageheader(lang('edit_sponsor'), "Update");
		contentsection_begin(lang('edit_sponsor'));
		if ( !isset($check) ) {
			$result = DBQuery("SELECT * FROM ".SCHEMANAME."vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($id)."'" );
			$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
		}
	}
	else {
		pageheader(lang('add_new_sponsor'), "Update");
		contentsection_begin(lang('add_new_sponsor'));
	}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
if (isset($sponsor) && $sponsor['admin']) {
	?><p><b>Note:</b> Users added to this sponsor will have administrative access to this calendar.</p><?php
} else {
	echo "<br>";
}
?>
<table border="0" cellpadding="2" cellspacing="0">
	<tr>
		<td valign="top">
			<strong><?php echo lang('sponsor_name'); ?></strong>
			<span class="WarningText">*</span>
		</td>
		<td valign="top">
<?php
		if ( isset($check) ) {
			if (empty($sponsor['name'])) {
				feedback(lang('choose_sponsor_name'),FEEDBACKNEG);
			}
			elseif ($sponsorexists) {
				feedback(lang('sponsor_already_exists'),FEEDBACKNEG);
			}
		}
?>
			<input type="text" size="50" name="sponsor[name]" maxlength=<?php echo MAXLENGTH_SPONSOR_NAME; ?>  value="<?php
		if ( isset($check) ) { $sponsor['name']=stripslashes($sponsor['name']); }
		if ( isset($sponsor['name']) ) { echo HTMLSpecialChars($sponsor['name']); }
?>"> <i><?php echo lang('sponsor_name_example'); ?></i><br>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<strong><?php echo lang('email'); ?>:</strong>
			<span class="WarningText">*</span>
		</td>
		<td valign="top">
<?php
	if (isset($check) && (empty($sponsor['email']))) {
		feedback(lang('choose_email'),FEEDBACKNEG);
	}
?>
			<input type="text" size="20" name="sponsor[email]" maxlength=<?php echo MAXLENGTH_EMAIL; ?> value="<?php
	if ( isset($check) ) { $sponsor['email']=stripslashes($sponsor['email']); }
	if ( isset($sponsor['email'])) { echo HTMLSpecialChars($sponsor['email']); }
?>">
			<i><?php echo lang('email_example'); ?></i><br>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<strong><?php echo lang('homepage'); ?>:</strong>
		</td>
		<td valign="top">
<?php
	if ( isset($check) && !checkURL($sponsor['url']) ) {
		feedback(lang('url_invalid'),FEEDBACKNEG);
	}
?>
			<input type="text" size="50" name="sponsor[url]" maxlength=<?php echo MAXLENGTH_URL; ?> value="<?php
	if ( isset($check) ) { $sponsor['url']=stripslashes($sponsor['url']); }
	if ( isset($sponsor['url']) ) { echo HTMLSpecialChars($sponsor['url']); }
?>">
			<i><?php echo lang('url_example'); ?></i><br>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<strong><?php
				if (isset($sponsor) && $sponsor['admin']) {
					echo lang('administrative_members');
				} else {
					echo lang('sponsor_members');
				}
			?></strong>
		</td>
		<td valign="top">
<?php
	if (!empty($addPIDError)) {    
		feedback($addPIDError,1);
	}
?>
		<textarea name="sponsor[admins]" cols="40" rows="3" wrap="virtual"><?php
		if ( isset($sponsor['admins']) ) {
			echo $sponsor['admins'];
		}
		elseif ( isset($id) ) {
			$query = "SELECT * FROM ".SCHEMANAME."vtcal_auth WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND sponsorid='".sqlescape($id)."' ORDER BY userid";
			$result = DBQuery($query ); 
			$i = 0;
			while ($i < $result->numRows()) {
				$authorization = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
				if ($i>0) { echo ","; }
				echo $authorization['userid'];
				$i++;
			}
		}
		?></textarea><br>
		<i><?php echo lang('administrative_members_example'); ?></i>
		</td>
	</tr>
</table>
	<input type="hidden" name="check" value="1">
<?php
	if ( isset ($id) ) { echo '<input type="hidden" name="id" value="',$id,'">'; }
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
