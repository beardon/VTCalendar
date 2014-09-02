<?php
require_once('application.inc.php');

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISMAINADMIN'] ) { exit; } // additional security

	if (!isset($_POST['cancel']) || !setVar($cancel,$_POST['cancel'],'cancel')) unset($cancel);
	if (!isset($_POST['save']) || !setVar($save,$_POST['save'],'save')) unset($save);
	if (!isset($_POST['check']) || !setVar($check,$_POST['check'],'check')) unset($check);
	if (!isset($_POST['new']) || !setVar($new,$_POST['new'],'check')) { 
		if (!isset($_GET['new']) || !setVar($new,$_GET['new'],'check')) unset($new);
	}
	if (isset($_GET['cal'])) {
		// Unset cal since we want nothing set but the id.
		unset($cal);
		if (!isset($_GET['cal']['id']) || !setVar($cal['id'],$_GET['cal']['id'],'calendarid')) unset($cal['id']);
	}
	elseif (isset($_POST['cal'])) { 
		if (!isset($_POST['cal']['id']) || !setVar($cal['id'],$_POST['cal']['id'],'calendarid')) unset($cal['id']);
		if (!isset($_POST['cal']['name']) || !setVar($cal['name'],$_POST['cal']['name'],'calendarname')) unset($cal['name']);
		if (!isset($_POST['cal']['admins']) || !setVar($cal['admins'],$_POST['cal']['admins'],'users')) unset($cal['admins']);
		if (!isset($_POST['cal']['forwardeventdefault']) || !setVar($cal['forwardeventdefault'],$_POST['cal']['forwardeventdefault'],'forwardeventdefault')) unset($cal['forwardeventdefault']);
	}
	else {
		unset($cal);
	}

	if (isset($cancel)) {
		redirect2URL("managecalendars.php");
		exit;
	}

	function checkcalendar(&$cal) {
		return (!empty($cal['id']) && !empty($cal['name']));
	}

	$calendarexists = false;
	$addPIDError="";
	if (isset($save) && checkcalendar($cal) ) {
		$query = "SELECT * FROM ".TABLEPREFIX."vtcal_calendar WHERE id='".sqlescape($cal['id'])."'";
		if (is_string($result =& DBQuery($query))) { DBErrorBox("Error determining if calendar already exists: " . $result); exit; };
		
		if (!isset($cal['forwardeventdefault']) || $cal['forwardeventdefault']!="1") { $cal['forwardeventdefault'] = "0"; }
		if (isset($new)) {
			$calendarexists = $result->numRows() > 0;
			$result->free();
			
			if (!$calendarexists) {
				$result->free();
				
				// create new calendar
				$query = "INSERT INTO ".TABLEPREFIX."vtcal_calendar (id, name, title, header, footer, viewauthrequired, forwardeventdefault) VALUES "
					."('".sqlescape($cal['id'])."','".sqlescape($cal['name'])."', '".lang('calendar')."', '', '', '0', '".sqlescape($cal['forwardeventdefault'])."')";
				if (is_string($result =& DBQuery($query))) { DBErrorBox("Error creating calendar: " . $result); exit; };

				$query = "INSERT INTO ".TABLEPREFIX."vtcal_sponsor (calendarid,name,email,url,admin) VALUES ('".sqlescape($cal['id'])."','".lang('administration')."','','".sqlescape(BASEURL.$cal['id'])."/"."','1')";
				if (is_string($result =& DBQuery($query))) { DBErrorBox("Error creating default sponsor: " . $result); exit; };
				
				// Create a default category
				$query = "INSERT INTO ".TABLEPREFIX."vtcal_category (calendarid,name) VALUES ('".sqlescape($cal['id'])."','General')";
				if (is_string($result =& DBQuery($query))) { DBErrorBox("Error creating default category: " . $result); exit; };
				
				//$result = DBQuery("INSERT INTO ".TABLEPREFIX."vtcal_category (calendarid,name) VALUES ('".sqlescape($cal['id'])."','".lang('category2')."')" );
				//$result = DBQuery("INSERT INTO ".TABLEPREFIX."vtcal_category (calendarid,name) VALUES ('".sqlescape($cal['id'])."','".lang('category3')."')" );
			}
		} // end: if ( isset($new) )
		else { 
			// update existing calendar
			$query = "UPDATE ".TABLEPREFIX."vtcal_calendar SET name='".sqlescape($cal['name'])."',forwardeventdefault='".sqlescape($cal['forwardeventdefault'])."' WHERE id='".sqlescape($cal['id'])."'";
			if (is_string($result =& DBQuery($query))) { DBErrorBox("Error updating calendar: " . $result); exit; };
		}
		
		if (!$calendarexists) {
			// check validity of cal-admins
			$pidsAdded = array();
			
			if (!empty($cal['admins']) ) {
				// disassemble the admins string and check all PIDs against the DB
				$pidsInvalid = "";
				$pidsTokens = split ( "[ ,;\n\t]", $cal['admins'] );
				for ($i=0; $i<count($pidsTokens); $i++) {
					$pidName = $pidsTokens[$i];
					$pidName = trim($pidName);
					$pidsAddedCount = 0;
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
				}
		
				// feedback message(s)
				if ( !empty($pidsInvalid) ) {
					if ( strpos($pidsInvalid, "," ) > 0 ) { // more than one user-ID
						$addPIDError = lang('user_ids_invalid')." &quot;".$pidsInvalid."&quot;";
					}
					else {
						$addPIDError = lang('user_id_invalid')." &quot;".$pidsInvalid."&quot;";
					}
				}
			}
			
			
			if (empty($addPIDError)) {  
				// determine the id of sponsor "Administration"
				$query = "SELECT id FROM ".TABLEPREFIX."vtcal_sponsor WHERE calendarid='".sqlescape($cal['id'])."' AND admin='1'";
				if (is_string($result =& DBQuery($query))) { DBErrorBox("Error determining ID of admin sponsor: " . $result); exit; };
				
				$s =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
				$administrationId = $s['id'];
				$result->free();
				
				// substitute existing auth info with the new one
				$query = "DELETE FROM vtcal_auth WHERE calendarid='".sqlescape($cal['id'])."' AND sponsorid='".sqlescape($administrationId)."'";
				if (is_string($result =& DBQuery($query))) { DBErrorBox("Error deleting users from admin sponsor: " . $result); exit; };
				
				for ($i=0; $i<count($pidsAdded); $i++) {
					$query = "INSERT INTO vtcal_auth (calendarid,userid,sponsorid) VALUES ('".$cal['id']."','".$pidsAdded[$i]."','".$administrationId."')";
					if (is_string($result =& DBQuery($query))) { DBErrorBox("Error adding user to admin sponsor: " . $result); exit; };
				}
				
				redirect2URL("managecalendars.php");
				exit;
			}
		}
	}

	if ( isset($cal['id']) ) {
		pageheader(lang('edit_calendar'), "Update");
		contentsection_begin(lang('edit_calendar'));
		if ( !isset($check) ) {
			$result =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_calendar WHERE id='".sqlescape($cal['id'])."'" );
			if (is_string($result)) {
				DBErrorBox("Error retrieving calendar info: " . $result);
				contentsection_end();
				pagefooter();
				DBclose();
				exit;
			}
			else {
				$cal = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
				$result->free();
			}
		}
	}
	else {
		pageheader(lang('add_new_calendar'), "Update");
		contentsection_begin(lang('add_new_calendar'));
	}
?>
<br>
<form method="post" action="editcalendar.php">
<table border="0" cellpadding="2" cellspacing="0">
	<tr>
		<td class="bodytext" valign="top">
			<?php echo lang('calendar_id'); ?>:
			<span class="WarningText">*</span>
		</td>
		<td class="bodytext" valign="top">
<?php
	if ( isset($check) ) {
		if (empty($cal['id']) || !isValidInput($cal['id'],'calendarid')) {
			feedback(lang('choose_valid_calendar_id')." ".constCalendaridVALIDMESSAGE,FEEDBACKNEG);
		}
		elseif ($calendarexists) {
			feedback(lang('calendar_already_exists'),FEEDBACKNEG);
		}
	}
?>
<?php
	if ( isset ($new) ) { 
?>
	<input type="text" size="20" name="cal[id]" maxlength=<?php echo MAXLENGTH_CALENDARID; ?> value="<?php
	if ( isset($check) ) { $cal['id']=stripslashes($cal['id']); }
	if ( isset($cal['id']) ) { echo HTMLSpecialChars($cal['id']); }
?>"> <i><?php echo lang('calendar_id_example'); ?></i>
<?php
	} // end: else: if ( isset ($cal['id']) )
	else {
		echo '<input type="hidden" name="cal[id]" value="',$cal['id'],'">';
		echo "<b>".$cal['id']."</b>\n"; 
	}
?>
<br>
		</td>
	</tr>
	<tr>
		<td class="bodytext" valign="top">
			<?php echo lang('calendar_name'); ?>:
			<span class="WarningText">*</span>
		</td>
		<td class="bodytext" valign="top">
<?php
	if ( isset($check) ) {
		if (empty($cal['name']) || !isValidInput($cal['name'],'calendarname')) {
			feedback(lang('choose_valid_calendar_name')." ".constCalendarnameVALIDMESSAGE,FEEDBACKNEG);
		}
	}
?>
			<input type="text" size="50" name="cal[name]" maxlength=<?php echo MAXLENGTH_CALENDARNAME; ?>  value="<?php
	if ( isset($check) ) { $cal['name']=stripslashes($cal['name']); }
	if ( isset($cal['name']) ) { echo HTMLSpecialChars($cal['name']); }
?>"> <i><?php echo lang('calendar_name_example'); ?></i><br>
		</td>
	</tr>
	<tr>
		<td class="bodytext" valign="top">
			<?php echo lang('administrators'); ?><br>
		</td>
		<td class="bodytext" valign="top">
<?php
	if (!empty($addPIDError)) {    
		feedback($addPIDError,1);
	}
?>
		<textarea name="cal[admins]" cols="40" rows="3" wrap="virtual"><?php
		if ( isset($cal['admins']) ) {
			echo $cal['admins'];
		}
		elseif ( isset($cal['id']) ) {
			// determine the automatically generated sponsor-id
			$result = DBQuery("SELECT id FROM ".TABLEPREFIX."vtcal_sponsor WHERE calendarid='".sqlescape($cal['id'])."' AND admin='1'" );
			$s = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
			$administrationId = $s['id'];
			$result->free();

			$query = "SELECT * FROM vtcal_auth WHERE calendarid='".sqlescape($cal['id'])."' AND sponsorid='".sqlescape($administrationId)."' ORDER BY userid";
			$result = DBQuery($query ); 
			$i = 0;
			while ($i < $result->numRows()) {
				$authorization = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
				if ($i>0) { echo ","; }
				echo $authorization['userid'];
				$i++;
			}
			$result->free();
		}
		?></textarea><br>
		<i><?php echo lang('administrators_example'); ?></i>
		</td>
	</tr>
<?php
	if ( !isset($cal['id']) || $cal['id'] != "default" ) {
?>
	<tr>
		<td class="bodytext" valign="top">&nbsp;</td>
		<td class="bodytext" valign="top">
<?php
	$result = DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_calendar WHERE id='default'" ); 
	$c = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	$defaultcalendarname = $c['name'];
?>
			<br>
			<table border="0">
				<tr align="left" valign="top">
					<td><input type="checkbox" name="cal[forwardeventdefault]" id="forwardeventdefault" value="1"<?php 
					if (isset($cal['forwardeventdefault']) && $cal['forwardeventdefault']=="1") { echo " checked"; } 
					?>></td>
					<td>
						 <label for="forwardeventdefault"><?php echo lang('also_display_on_calendar_message'); ?> <?php echo $defaultcalendarname ?></label><br>
			<?php echo lang('also_display_on_calendar_notice'); ?></td>
				</tr>
			</table>
		</td>
	</tr>
<?php
	} // end: if ( $cal['id'] != "default" ) {
?>	
	<tr>
		<td>&nbsp;</td>
		<td>
		<input type="hidden" name="check" value="1">
<?php
	if ( isset($new) ) {
		echo '<input type="hidden" name="new" value="1">';
	}
?>		
		<br>
		<input type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
		<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
		</td>
	</tr>
</table>
</form>
<?php
contentsection_end();
pagefooter();
DBclose();
?>