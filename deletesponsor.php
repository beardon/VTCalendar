<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  if (!authorized($database)) { exit; }
  if (!$_SESSION["AUTH_ADMIN"]) { exit; } // additional security

  if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
  if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
  if (isset($_POST['deleteevents'])) { setVar($deleteevents,$_POST['deleteevents'],'deleteevents'); } else { unset($deleteevents); }
  if (isset($_POST['id'])) { setVar($id,$_POST['id'],'sponsorid'); } 
	else { 
	  if (isset($_GET['id'])) { setVar($id,$_GET['id'],'sponsorid'); }
		else {
		  unset($id); 
		}
	}
  if (isset($_POST['newsponsorid'])) { setVar($newsponsorid,$_POST['newsponsorid'],'sponsorid'); } else { unset($newsponsorid); }


  if (isset($cancel)) {
    redirect2URL("managesponsors.php");
    exit;
  }

  // make sure the sponsor exists
	$result = DBQuery($database, "SELECT * FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($id)."'" );
	if ( $result->numRows() != 1 ) {
		redirect2URL("managesponsors.php");
		exit;
	}
	else {
		$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	}

  if (isset($save) ) {
    if ($deleteevents=="1") {
		  $result = DBQuery($database, "DELETE FROM vtcal_event WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND sponsorid='".sqlescape($id)."'" );
		  $result = DBQuery($database, "DELETE FROM vtcal_event_public WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND sponsorid='".sqlescape($id)."'" );
		}
		else {
   		$result = DBQuery($database, "UPDATE vtcal_event SET sponsorid='".sqlescape($newsponsorid)."' WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND sponsorid='".sqlescape($id)."'" );
   		$result = DBQuery($database, "UPDATE vtcal_event_public SET sponsorid='".sqlescape($newsponsorid)."' WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND sponsorid='".sqlescape($id)."'" );
		}
		$result = DBQuery($database, "DELETE FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($id)."'" );
    $result = DBQuery($database, "DELETE FROM vtcal_auth WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND sponsorid='".sqlescape($id)."'" ); 
    redirect2URL("managesponsors.php");
    exit;
  }

  pageheader("Delete Sponsor, Event Calendar",
             "Delete Sponsor",
             "Update","",$database);
  echo "<BR>";
  box_begin("inputbox","Delete Sponsor");
?>
<font color="#ff0000"><b>Warning!</b></font> The sponsor &quot;<b><?php echo $sponsor['name']; ?></b>&quot; will be deleted.
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input type="radio" name="deleteevents" value="1"> delete all events belonging to this sponsor<br>
  <input type="radio" name="deleteevents" value="0" checked> 
	re-assign all events belonging to this sponsor to:
  <select name="newsponsorid" size="1">
<?php
  $result = DBQuery($database, "SELECT * FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id!='".sqlescape($id)."' ORDER BY name" ); 

  // print list with categories from the DB
  for ($i=0; $i<$result->numRows(); $i++) {
    $newsponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
    echo "<option ";
    echo "value=\"".$newsponsor['id']."\">".$newsponsor['name']."</option>\n";
  }
?>
  </select>
<?php
  if ( isset ($id) ) { echo '<input type="hidden" name="id" value="'.$id.'">'; }
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