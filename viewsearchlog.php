<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  if (!authorized($database)) { exit; }
  if (!$_SESSION["AUTH_ADMIN"]) { exit; } // additional security
 
	pageheader("View search log, Event Calendar",
					 "View search log",
					 "Update","",$database);
	echo "<BR>\n";
	box_begin("inputbox","View search log");

?>
<form method="post" action="update.php">
	<input type="submit" name="back" value="&laquo; Back to menu">
</form>
<a href="deletesearchlog.php">Clear search log</a>
<img src="images/spacer.gif" width="400" height="1" alt="1">
<?php
  box_end();
?>
<br>
<pre>
<?php
  $result = DBQuery($database, "SELECT * FROM vtcal_searchlog WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' ORDER BY time" ); 
  if ( $result->numRows() > 0 ) {
		for ($i=0; $i<$result->numRows(); $i++) {
			$searchlog = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			echo "    ",$searchlog['time'],"  ",str_pad($searchlog['ip'], 15, " ", STR_PAD_LEFT)," ",str_pad($searchlog['numresults'], 5, " ", STR_PAD_LEFT),"   ",$searchlog['keyword'],"<br>";
		} // end: for ($i=0; $i<$result->numRows(); $i++)
  }
	else {
	  echo "    Search log is empty.";
	}
?>	
</pre>
<?php
  echo "<br><br>\n";
  require("footer.inc.php");
?>