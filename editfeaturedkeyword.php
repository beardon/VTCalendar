<?php
require_once('application.inc.php');

	if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
	if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
	if (isset($_POST['check'])) { setVar($check,$_POST['check'],'check'); } else { unset($check); }
	if (isset($_POST['keyword'])) { setVar($keyword,$_POST['keyword'],'keyword'); } else { unset($keyword); }
	if (isset($_POST['featuretext'])) { setVar($featuretext,$_POST['featuretext'],'featuretext'); } else { unset($featuretext); }
	if (isset($_POST['id'])) { setVar($id,$_POST['id'],'searchkeywordid'); } else { 
		if (isset($_GET['id'])) { setVar($id,$_GET['id'],'searchkeywordid'); } else { unset($id); }
 }

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

	if (isset($cancel)) {
		redirect2URL("managefeaturedsearchkeywords.php");
		exit;
	}

	$keywordexists = false;
	if (isset($save) && !empty($keyword) && !empty($featuretext) ) {
		$result = DBQuery("SELECT * FROM vtcal_searchfeatured WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND keyword='".sqlescape($keyword)."'" );
		if ( $result->numRows()>0 ) {
			if ($result->numRows()>1) {
				$keywordexists = true;
			}
			else { // exactly one result
				if ( isset ($id) ) {
					$searchkeyword = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
					if ( $searchkeyword['id'] != $id ) {
						$keywordexists = true;
					}
				}
				else {
					$keywordexists = true;
				}			
			}
		}

		if (!$keywordexists) {
			if ( isset ($id) ) { // edit, not new
				$result = DBQuery("UPDATE vtcal_searchfeatured SET keyword='".sqlescape(strtolower($keyword))."',featuretext='".sqlescape($featuretext)."' WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($id)."'" );
			}
			else {
				$result = DBQuery("INSERT INTO vtcal_searchfeatured (calendarid,keyword,featuretext) VALUES ('".sqlescape($_SESSION['CALENDAR_ID'])."','".sqlescape(strtolower($keyword))."','".sqlescape($featuretext)."')" );
			}
			redirect2URL("managefeaturedsearchkeywords.php");
			exit;
		} // end: if (!$keywordexists) 
	}

	if ( isset($id) ) {
		pageheader(lang('edit_featured_keyword'), "Update");
		contentsection_begin(lang('edit_featured_keyword'));
		if ( !isset($check) ) {
			$result = DBQuery("SELECT * FROM vtcal_searchfeatured WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($id)."'" );
			$searchkeyword = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
			$keyword = $searchkeyword['keyword'];
			$featuretext = $searchkeyword['featuretext'];
		}
	}
	else {
		pageheader(lang('add_new_featured_keyword'), "Update");
		contentsection_begin(lang('add_new_featured_keyword'));
	}
?>
<br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<?php echo lang('featured_keyword_message'); ?><br>
	<br>
	<b><?php echo lang('keyword'); ?>:</b><br>
<?php
	if ( isset($check) ) {
		if ($keywordexists) {
			feedback(lang('keyword_already_exists'),FEEDBACKNEG);
		}
		elseif ( empty($keyword) ) {
			feedback(lang('keyword_cannot_be_empty'),FEEDBACKNEG);
		} 
	}
?>
	<input type="text" name="keyword" maxlength="100" size="20" value="<?php 
	if (!empty($keyword)) {	echo HTMLSpecialChars($keyword); }
	?>">
	<br>
	<br>
		
	<b><?php echo lang('featured_text'); ?></b><br>
<?php
	if ( isset($check) ) {
		if ( empty($featuretext) ) {
			feedback(lang('featured_text_cannot_be_empty'),FEEDBACKNEG);
		} 
	}
?>
	<textarea cols="60" rows="6" name="featuretext" wrap="virtual"><?php 
	if (!empty($featuretext)) {
		echo HTMLSpecialChars($featuretext); 
	}
	?></textarea>
	<input type="hidden" name="check" value="1">
<?php
	if ( !empty($id) ) { echo '<input type="hidden" name="id" value="',$id,'">'; }
?>
	<BR>
	<BR>
	<INPUT type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
	<INPUT type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
</form>
<?php
	contentsection_end();
	pagefooter();
DBclose();
?>
