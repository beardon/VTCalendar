<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  if (!authorized($database)) { exit; }
  if (!$_SESSION["AUTH_ADMIN"]) { exit; } // additional security
 
	pageheader("Manage search keywords, Event Calendar",
					 "Manage search keywords",
					 "Update","",$database);
	echo "<BR>\n";
	box_begin("inputbox","Manage search keywords");

  $result = DBQuery($database, "SELECT * FROM vtcal_searchkeyword WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' ORDER BY keyword" ); 
?>
<form method="post" action="update.php">
	<input type="submit" name="back" value="&laquo; Back to menu">
</form>
The following list contains keywords which are tried by the calendar search engine<br>
in addition to the keyword provided by the user. You can improve the search engine's<br>
power by building a list of common synonyms (or alternative keywords) for <br>
frequently-used keywords.<br>
<br>

<a href="addnewkeywordpair.php">Add new keywords pair</a>
<?php
  if ($result->numRows() > 0 ) {
?>
or manage existing pairs:<br>
<br>
<table border="0" cellspacing="0" cellpadding="4">
  <tr bgcolor="#CCCCCC">
    <td bgcolor="#CCCCCC"><b>Keyword</b></td>
    <td bgcolor="#CCCCCC"><b>Alternative Keyword</b></td>
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
    <td bgcolor="<?php echo $color; ?>"><?php echo $searchkeyword['alternative']; ?></td>
    <td bgcolor="<?php echo $color; ?>"><a href="deletekeywordpair.php?id=<?php echo $searchkeyword['id']; ?>">delete</a></td>
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