<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  if (!authorized($database)) { exit; }

  if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
  if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
  if (isset($_POST['user_oldpassword'])) { setVar($user_oldpassword,$_POST['user_oldpassword'],'password'); } else { unset($user_oldpassword); }
  if (isset($_POST['user_newpassword1'])) { setVar($user_newpassword1,$_POST['user_newpassword1'],'password'); } else { unset($user_newpassword1); }
  if (isset($_POST['user_newpassword2'])) { setVar($user_newpassword2,$_POST['user_newpassword2'],'password'); } else { unset($user_newpassword2); }

  if (isset($cancel)) {
    redirect2URL("update.php");
    exit;
  }

  if (isset($save)) {
    $user['oldpassword']=$user_oldpassword;
    $user['newpassword1']=$user_newpassword1;
    $user['newpassword2']=$user_newpassword2;

    $oldpw_error = checkoldpassword($user,$_SESSION["AUTH_USERID"],$database);
    $newpw_error = checknewpassword($user,$database);
    if ($oldpw_error==0) {
      if ($newpw_error==0) { // new password is valid
        // save password to DB
        $result = DBQuery($database, "UPDATE vtcal_user SET password='".sqlescape(crypt($user['newpassword1']))."' WHERE id='".sqlescape($_SESSION["AUTH_USERID"])."'" ); 

        // reroute to sponsormenu page
        redirect2URL("update.php?fbid=passwordchangesuccess");
        exit;
      }
    }
  }

  pageheader("VT Event Calendar, Change Password",
             "Change Password",
	           "","",$database);

  echo "<BR>";
  box_begin("inputbox","Change password");
?>
<B>Please enter the following information:</B><BR>
<FORM method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <TABLE border="0" cellpadding="2" cellspacing="0">
    <TR>
      <TD class="bodytext" valign="top">
        Old Password
      </TD>
      <TD class="bodytext" valign="top">
<?php
    if (isset($save) && $oldpw_error) {
      feedback("The password you entered as the old one is wrong. Please try again.",1);
    }
?>
        <INPUT type="password" name="user_oldpassword" maxlength="20" size="20" value="">
        <I>&nbsp;(case sensitive)</I>
      </TD>
    </TR>
    <TR>
      <TD class="bodytext" valign="top">
        New Password
      </TD>
      <TD class="bodytext" valign="top">
<?php
  if (isset($save)) {
    if ($newpw_error == 1) {
      feedback("The two values you entered for the new password do not agree. Please try again.",1);
    }
    elseif ($newpw_error == 2) {
      feedback("The new password is invalid. It must have a length of at least 5 characters.",1);
    } // end: if ($newpw_error == 2)
  } // end: if (isset($save))
?>
        <INPUT type="password" name="user_newpassword1" maxlength="20" size="20" value="">
        <I>&nbsp;(case sensitive)</I>
      </TD>
    </TR>
    <TR>
      <TD class="bodytext" valign="top">
        New Password<BR>(repeated)
      </TD>
      <TD class="bodytext" valign="top">
        <INPUT type="password" name="user_newpassword2" maxlength="20" size="20" value="">
        <I>&nbsp;(case sensitive)</I>
      </TD>
    </TR>
  </TABLE>
  <BR>
  <INPUT type="submit" name="save" value="Save">
  <INPUT type="submit" name="cancel" value="Cancel">
</FORM>
<?php
  box_end();
  echo "<BR>";
  require("footer.inc.php");
?>