<?php
require_once('application.inc.php');

if (!authorized()) { exit; }
if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

// Get the start and end range.
if (!isset($_GET['rangestart']) || ($rangestart = strtotime($_GET['rangestart'])) === false) { unset($rangestart); }
if (!isset($_GET['rangeend']) || ($rangeend = strtotime($_GET['rangeend'])) === false) { $rangeend = time(); }

// Set the start to 21 days before the end, if the start is not set.
if (!isset($rangestart)) {
	$rangestart = strtotime(date("Y-m-d", $rangeend) . " -21 days");
}

// Create the start and end timestamps.
$rangestartTimestamp = datetime2timestamp(date("Y", $rangestart), date("m", $rangestart), date("d", $rangestart), $day_beg_h, 0, "am");
$rangeendTimestamp = datetime2timestamp(date("Y", $rangeend), date("m", $rangeend), date("d", $rangeend), $day_end_h, 59, "pm");

pageheader(lang('view_search_log'), "Update");
contentsection_begin(lang('view_search_log'),true);

?>
<a href="deletesearchlog.php"><?php echo lang('clear_search_log'); ?></a>

<form method="get" action="viewsearchlog.php">
	<table  border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td>View entries from</td>
				<td><input type="textbox" name="rangestart" value="<?php echo date("n/j/Y", $rangestart) ?>" size="10"></td>
				<td>to</td>
				<td><input type="textbox" name="rangestart" value="<?php echo date("n/j/Y", $rangeend) ?>" size="10"></td>
				<td><input type="submit" value="Show"></td>
				<td> (m/d/yyyy)</td>
	 		</tr>
			</table>
</form>

<?php
$result =& DBQuery("SELECT * FROM vtcal_searchlog WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND time >= '" . $rangestartTimestamp . "' AND time <= '" . $rangeendTimestamp . "' ORDER BY time DESC"); 
	
if (is_string($result)) {
	DBErrorBox($result);
}
else {
	if ( $result->numRows() == 0 ) {
		echo "<p><b>" . lang('search_log_is_empty') . "</b></p>";
	}
	else {
		echo "<pre>";
		for ($i=0; $i<$result->numRows(); $i++) {
			$searchlog =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			echo htmlentities($searchlog['time']);
			echo "  ", str_pad($searchlog['ip'], 15, " ", STR_PAD_LEFT)," ";
			echo str_pad($searchlog['numresults'], 5, " ", STR_PAD_LEFT),"   ";
			echo htmlentities($searchlog['keyword']),"<br>";
		}
		echo "</pre>";
	}
}

contentsection_end();
pagefooter();
DBclose();
?>