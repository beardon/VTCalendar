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
  if (isset($_POST['deleteconfirmed'])) { setVar($deleteconfirmed,$_POST['deleteconfirmed'],'deleteconfirmed'); } else { unset($deleteconfirmed); }
  if (isset($_POST['userid'])) { setVar($userid,$_POST['userid'],'userid'); } 
	else {   
	  if (isset($_GET['userid'])) { setVar($userid,$_GET['userid'],'userid'); } else { unset($userid); }
  }

  if (isset($cancel)) {
    redirect2URL("managemainadmins.php");
    exit;
  }

  if (isset($deleteconfirmed)) {
    // get the user from the database
    $result = DBQuery($database, "DELETE FROM vtcal_adminuser WHERE id='".sqlescape($userid)."'" );
    redirect2URL("managemainadmins.php");
    exit;
  }
  elseif (isset($check) && empty($userid)) {
    // reroute to sponsormenu page
    redirect2URL("update.php?fbid=userdeletefailed");
    exit;
  }

  // print page header
  pageheader(lang('delete_main_admin'),
             lang('delete_main_admin'),
             "","",$database);
  echo "<BR>";
  box_begin("inputbox",lang('delete_main_admin'));
?>
<FORM method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <B><?php echo lang('delete_main_admin_confirm'); ?> &quot;<?php echo $userid; ?>&quot;</B>
  <BR>
  <BR>
  <INPUT type="hidden" name="userid" value="<?php echo $userid; ?>">
  <INPUT type="hidden" name="deleteconfirmed" value="1">
  <INPUT type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>">
  <INPUT type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
  <BR>
</FORM>
<?php
  box_end();
  echo "<BR>";
  require("footer.inc.php");
?>