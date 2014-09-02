<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
  if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
  if (isset($_POST['check'])) { setVar($check,$_POST['check'],'check'); } else { unset($check); }
  if (isset($_POST['keyword'])) { setVar($keyword,$_POST['keyword'],'keyword'); } else { unset($keyword); }
  if (isset($_POST['featuretext'])) { setVar($featuretext,$_POST['featuretext'],'featuretext'); } else { unset($featuretext); }
  if (isset($_POST['id'])) { setVar($id,$_POST['id'],'searchkeywordid'); } else { 
	  if (isset($_GET['id'])) { setVar($id,$_GET['id'],'searchkeywordid'); } else { unset($id); }
 }

  $database = DBopen();
  if (!authorized($database)) { exit; }
  if (!$_SESSION["AUTH_ADMIN"]) { exit; } // additional security

  if (isset($cancel)) {
    redirect2URL("managefeaturedsearchkeywords.php");
    exit;
  }

  $keywordexists = false;
  if (isset($save) && !empty($keyword) && !empty($featuretext) ) {
    $result = DBQuery($database, "SELECT * FROM vtcal_searchfeatured WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND keyword='".sqlescape($keyword)."'" );
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
				$result = DBQuery($database, "UPDATE vtcal_searchfeatured SET keyword='".sqlescape(strtolower($keyword))."',featuretext='".sqlescape($featuretext)."' WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($id)."'" );
			}
			else {
				$result = DBQuery($database, "INSERT INTO vtcal_searchfeatured (calendarid,keyword,featuretext) VALUES ('".sqlescape($_SESSION["CALENDARID"])."','".sqlescape(strtolower($keyword))."','".sqlescape($featuretext)."')" );
			}
			redirect2URL("managefeaturedsearchkeywords.php");
			exit;
    } // end: if (!$keywordexists) 
	}

  if ( isset($id) ) {
    pageheader("Edit Featured Keyword, Event Calendar",
               "Edit Featured Keyword",
               "Update","",$database);
    echo "<BR>";
    box_begin("inputbox","Edit Featured Keyword");
		if ( !isset($check) ) {
  		$result = DBQuery($database, "SELECT * FROM vtcal_searchfeatured WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($id)."'" );
      $searchkeyword = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
		  $keyword = $searchkeyword['keyword'];
  		$featuretext = $searchkeyword['featuretext'];
		}
	}
	else {
    pageheader("Add New Featured Keyword, Event Calendar",
               "Add New Featured Keyword",
               "Update","",$database);
    echo "<BR>";
    box_begin("inputbox","Add New Featured Keyword");
	}
?>
<br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  Do NOT add multiple words. A keyword must not contain spaces.<br>
	<br>
	<b>Keyword:</b><br>
<?php
  if ( isset($check) ) {
		if ($keywordexists) {
			feedback("This keyword already exists.",1);
		}
		elseif ( empty($keyword) ) {
			feedback("The keyword cannot be empty.",1);
		} 
  }
?>
  <input type="text" name="keyword" maxlength="100" size="20" value="<?php 
	if (!empty($keyword)) {	echo HTMLSpecialChars($keyword); }
	?>">
	<br>
	<br>
		
  <b>Featured Text (or HTML):</b><br>
<?php
  if ( isset($check) ) {
		if ( empty($featuretext) ) {
			feedback("The featured text cannot be empty.",1);
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
  <INPUT type="submit" name="save" value="&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;">
  <INPUT type="submit" name="cancel" value="Cancel">
</form>
<?php
  box_end();
  echo "<BR>";
  require("footer.inc.php");
?>
