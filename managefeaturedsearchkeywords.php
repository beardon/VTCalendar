<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  if (!authorized($database)) { exit; }
  if (!$_SESSION["AUTH_ADMIN"]) { exit; } // additional security
 
	pageheader("Manage featured search keywords, Event Calendar",
					 "Manage featured search keywords",
					 "Update","",$database);
	echo "<BR>\n";
	box_begin("inputbox","Manage featured search keywords");

  $result = DBQuery($database, "SELECT * FROM vtcal_searchfeatured WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' ORDER BY keyword" ); 
?>
<form method="post" action="update.php">
	<input type="submit" name="back" value="&laquo; Back to menu">
</form>
Below you can associate certain search keywords with custom<br>
text messages or HTML. This can be used to answer to keywords<br>
which are frequently used but rarely have a match within the<br>
calendar.<br>
<br>

<a href="editfeaturedkeyword.php">Add new featured keyword</a>
<?php
  if ($result->numRows() > 0 ) {
?>
or manage existing keywords:<br>
<br>
<table border="0" cellspacing="0" cellpadding="4">
  <tr bgcolor="#CCCCCC">
    <td bgcolor="#CCCCCC"><b>Keyword</b></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?php
  $color = "#eeeeee";
  for ($i=0; $i<$result->numRows(); $i++) {
    $searchkeyword = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
		if ( $color == "#eeeeee" ) { $color = "#ffffff"; } else { $color = "#eeeeee"; }
?>	
  <tr bgcolor="<?php echo $color; ?>">
    <td bgcolor="<?php echo $color; ?>"><?php echo $searchkeyword['keyword']; ?></td>
    <td bgcolor="<?php echo $color; ?>">&nbsp;<a href="editfeaturedkeyword.php?id=<?php echo $searchkeyword['id']; ?>">edit</a>&nbsp;&nbsp; <a href="deletefeaturedkeyword.php?id=<?php echo $searchkeyword['id']; ?>">delete</a></td>
  </tr>
<?php
  } // end: for ($i=0; $i<$result->numRows(); $i++)
?>	
</table>
<form method="post" action="update.php">
	<input type="submit" name="back" value="&laquo; Back to menu">
</form>

<?php
  } // end: if ($result->numRows() > 0 )
  box_end();
  echo "<br><br>\n";
  require("footer.inc.php");
?>