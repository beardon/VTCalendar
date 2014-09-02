<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  if (!authorized($database)) { exit; }
  if (!$_SESSION["AUTH_MAINADMIN"]) { exit; } // additional security

	pageheader("Manage Main Admins, Event Calendar",
					 "Manage Main Admins",
					 "Update","",$database);
	echo "<BR>\n";
	box_begin("inputbox","Manage Main Admins");
?>
<form method="post" action="update.php">
	<input type="submit" name="back" value="&laquo; Back to menu">
</form>
<form method="post" name="mainform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<a href="addmainadmin.php">Add new main admin</a>
or delete existing:<br>
<br>
<table border="0" cellspacing="0" cellpadding="4">
  <tr bgcolor="#CCCCCC">
    <td bgcolor="#CCCCCC"><b>Main admin user-ID</b></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?php
  $result = DBQuery($database, "SELECT * FROM vtcal_adminuser ORDER BY id" ); 

  $color = "#eeeeee";
  for ($i=0; $i<$result->numRows(); $i++) {
    $user = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
		if ( $color == "#eeeeee" ) { $color = "#ffffff"; } else { $color = "#eeeeee"; }
?>	
  <tr bgcolor="<?php echo $color; ?>">
    <td bgcolor="<?php echo $color; ?>"><?php echo $user['id']; ?></td>
    <td bgcolor="<?php echo $color; ?>"><a href="deletemainadmin.php?userid=<?php echo $user['id']; ?>">delete</a></td>
  </tr>
<?php
  } // end: for ($i=0; $i<$result->numRows(); $i++)
?>	
</table>
<br>
<b><?php echo $result->numRows(); ?> Main admins total</b>
</form>
<form method="post" action="update.php">
	<input type="submit" name="back" value="&laquo; Back to menu">
</form>
<?php
  box_end();
  echo "<br><br>\n";
  require("footer.inc.php");
?>