<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  if (!authorized($database)) { exit; }
  if (!$_SESSION["AUTH_ADMIN"]) { exit; } // additional security

  if (isset($_POST['edit'])) { setVar($edit,$_POST['edit'],'edit'); } else { unset($edit); }
  if (isset($_POST['delete'])) { setVar($delete,$_POST['delete'],'delete'); } else { unset($delete); }
  if (isset($_POST['id'])) { setVar($id,$_POST['id'],'sponsorid'); } else { unset($id); }

  if ( isset($edit) ) {
	  redirect2URL("editsponsor.php?id=".$id); exit;
	}
  elseif ( isset($delete) ) {
    $result = DBQuery($database, "SELECT * FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($id)."'" ); 
    $sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
    
		if ( $sponsor['admin'] == 0 ) {
	    redirect2URL("deletesponsor.php?id=".$id);
		}
	}
 
	pageheader("Manage sponsors, Event Calendar",
					 "Manage sponsors",
					 "Update","",$database);
	echo "<BR>\n";
	box_begin("inputbox","Manage sponsors");
?>
<form method="post" action="update.php">
	<input type="submit" name="back" value="&laquo; Back to menu">
</form>
<form method="post" name="mainform" action="managesponsors.php">
<a href="editsponsor.php">Add new sponsor</a>
or modify existing sponsor:<br>
<br>
<?php
  $numLines = 15;
?>
<select name="id" size="<?php echo $numLines; ?>">
<?php
  $result = DBQuery($database, "SELECT * FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' ORDER BY name" ); 

  for ($i=0; $i<$result->numRows(); $i++) {
    $sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
?>	
  <option value="<?php echo $sponsor['id']; ?>"><?php echo $sponsor['name']; ?></option>
<?php
  } // end: for ($i=0; $i<$result->numRows(); $i++)
?>	
</select><br>
<input type="submit" name="edit" value="&nbsp;&nbsp;Edit&nbsp;&nbsp;">
<input type="submit" name="delete" value="Delete"><br>
<br>
<b><?php echo $result->numRows(); ?> Sponsors total</b>
</form>
<script language="JavaScript" type="text/javascript"><!--
document.mainform.id.focus();
//--></script>
<form method="post" action="update.php">
	<input type="submit" name="back" value="&laquo; Back to menu">
</form>

<?php
  box_end();
  echo "<br><br>\n";
  require("footer.inc.php");
?>