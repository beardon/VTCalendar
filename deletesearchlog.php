<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
  if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }

  $database = DBopen();
  if (!authorized($database)) { exit; }
  if (!$_SESSION["AUTH_ADMIN"]) { exit; } // additional security

  if (isset($cancel)) {
    redirect2URL("viewsearchlog.php");
    exit;
  }

  if (isset($save) ) {
	  $result = DBQuery($database, "DELETE FROM vtcal_searchlog WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."'" );
    redirect2URL("viewsearchlog.php");
    exit;
  }

  pageheader("Clear search log, Event Calendar",
             "Clear search log",
             "Update","",$database);
  echo "<BR>";
  box_begin("inputbox","Clear search log");
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  Do you want to delete the entire search log?
	<BR>
  <INPUT type="submit" name="save" value="&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;">
  <INPUT type="submit" name="cancel" value="Cancel">
</form>
<?php
  box_end();
  echo "<BR>";
  require("footer.inc.php");
?>