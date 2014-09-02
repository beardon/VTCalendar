<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  if (!authorized($database)) { exit; }
  if (!$_SESSION["AUTH_ADMIN"]) { exit; } // additional security

  if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
  if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
  if (isset($_POST['check'])) { setVar($check,$_POST['check'],'check'); } else { unset($check); }
  if (isset($_POST['keyword'])) { setVar($keyword,$_POST['keyword'],'keyword'); } else { unset($keyword); }
  if (isset($_POST['alternativekeyword'])) { setVar($alternativekeyword,$_POST['alternativekeyword'],'keyword'); } else { unset($alternativekeyword); }

  if (isset($cancel)) {
    redirect2URL("managesearchkeywords.php");
    exit;
  }

  if (isset($save) && !empty($keyword) && !empty($alternativekeyword) ) {
    $result = DBQuery($database, "INSERT INTO vtcal_searchkeyword (calendarid,keyword,alternative) VALUES ('".sqlescape($_SESSION["CALENDARID"])."','".sqlescape(strtolower($keyword))."','".sqlescape(strtolower($alternativekeyword))."')" );
    redirect2URL("managesearchkeywords.php");
    exit;
  }

  pageheader("Add New Keywords Pair, Event Calendar",
             "Add New Keywords Pair",
             "Update","",$database);
  echo "<BR>";
  box_begin("inputbox","Add New Keywords Pair");
?>
<br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  &nbsp;Do NOT add multiple words.<br>
	&nbsp;A keyword (or alternative keyword) must
	not contain spaces.
	<br>
	<table cellpadding="3" cellspacing="3" border="0">
	  <tr>
		  <td><b>Keyword:</b>
<?php
  if ( isset($check) ) {
		if ( empty($keyword) ) {
			feedback("<br>The keyword cannot be empty.",1);
		} 
  }
?>
			</td>
		  <td><b>Alternative Keyword:</b>
<?php
  if ( isset($check) ) {
		if ( empty($alternativekeyword) ) {
			feedback("<br>The alternative keyword cannot be empty.",1);
		} 
  }
?>
			</td>
		</tr>
	  <tr>
		  <td>
			  <input type="text" name="keyword" maxlength="<?php echo constKeywordMaxLength; ?>" size="20" value="<?php 
				if (!empty($keyword)) { echo HTMLSpecialChars($keyword); }
				?>">
			</td>
		  <td>
			  <input type="text" name="alternativekeyword" maxlength="<?php echo constKeywordMaxLength; ?>" size="20" value="<?php 
				if (!empty($alternativekeyword)) { echo HTMLSpecialChars($alternativekeyword); } 
				?>">
			</td>
		</tr>
	</table>
	<input type="hidden" name="check" value="1">
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