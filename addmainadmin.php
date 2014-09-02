<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  if (!authorized($database)) { exit; }
  if (!$_SESSION["AUTH_MAINADMIN"]) { exit; } // additional security

  if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
  if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
  if (isset($_POST['check'])) { setVar($check,$_POST['check'],'check'); } else { unset($check); }
  if (isset($_POST['userid'])) { setVar($userid,$_POST['userid'],'userid'); } else { unset($userid); }

	function checkuser(&$user) {
    return (!empty($user['id']) && isValidInput($user['id'],'userid'));
  }

	function mainAdminExistsInDB($database, $userid) {
		$query = "SELECT count(id) FROM vtcal_adminuser WHERE id='".sqlescape($userid)."'";
		$result = DBQuery($database, $query ); 
		$r = $result->fetchRow(0);
		if ($r[0]>0) { return true; }
		
		return false; // default rule
	}	

  if (isset($cancel)) {
    redirect2URL("managemainadmins.php");
    exit;
  };

	if (!empty($userid)) { $user['id'] = $userid; } else { $user['id'] = ""; }
  if (isset($save) && checkuser($user) && !mainAdminExistsInDB($database, $user['id']) && isValidUser($database, $user['id']) ) { // save user into DB
		$query = "INSERT INTO vtcal_adminuser (id) VALUES ('".sqlescape($user['id'])."')";
		$result = DBQuery($database, $query ); 

		// reroute to sponsormenu page
		redirect2URL("managemainadmins.php");
    exit;
  } // end: if (isset($save))

  // print page header
  if (!empty($chooseuser)) {
    if (empty($userid)) { // no user was selected
      // reroute to sponsormenu page
      redirect2URL("update.php?fbid=userupdatefailed");
      exit;
    }
    else {
      pageheader("VT Event Calendar, Edit User",
               "Edit User",
	             "","",$database);
      echo "<BR>\n";
      box_begin("inputbox","Edit User");
		}
  }
  else {
    pageheader("VT Event Calendar, Add New User",
               "Add New User",
               "","",$database);
    echo "<BR>\n";
    box_begin("inputbox","Add new user");
  }
  if (isset($user['id']) && (!isset($check) || $check != 1)) { // load user to update information if it's the first time the form is viewed
    $result = DBQuery($database, "SELECT * FROM vtcal_user WHERE id='".sqlescape($user['id'])."'" ); 
    $user = $result->fetchRow(DB_FETCHMODE_ASSOC);
  } // end if: "if (isset($userid))"
?>
<FORM method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="mainform">
<TABLE border="0" cellpadding="2" cellspacing="0">
  <TR>
    <TD class="bodytext" valign="baseline">
      <b>User-ID:</b>
    </TD>
    <TD class="bodytext" valign="baseline">
<?php
  	if (isset($check) && $check && (empty($userid))) {
      feedback("Please choose a user-id.",1);
    }
    if (isset($check) && $check && mainAdminExistsInDB($database,$userid)) {
      feedback("This user is already a main admin.",1);
    }
    if (isset($check) && $check && !isValidUser($database, $userid)) {
      feedback("This user does not exist.",1);
    }
?><INPUT type="text" size="20" name="userid" maxlength="50" value="<?php
  if (!empty($userid)) {
		if ($check) { $userid=stripslashes($userid); }
  	echo $userid;
	}
?>"> <I>(e.g. jsmith)</I>
<BR>
    </TD>
  </TR>
  <tr>
	  <td>&nbsp;</td>
	  <td>
		  <INPUT type="submit" name="save" value="&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;">
      <INPUT type="submit" name="cancel" value="Cancel">
    </td>
	</tr>
</TABLE>
<INPUT type="hidden" name="check" value="1">
<script language="JavaScript" type="text/javascript"><!--
document.mainform.userid.focus();
//--></script>
</FORM>
<?php
  box_end();
  echo "<br><br>";
  require("footer.inc.php");
?>