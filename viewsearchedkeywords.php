<?php
require_once('application.inc.php');

if (!authorized()) { exit; }
if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

$lang['searched_keywords'] = 'Searched Keywords';

if (!isset($_GET['rangestart']) || ($rangestart = strtotime($_GET['rangestart'])) === false) { unset($rangestart); }
if (!isset($_GET['rangeend']) || ($rangeend = strtotime($_GET['rangeend'])) === false) { $rangeend = time(); }

$rangeend = date("Y-m-d", $rangeend);
if (isset($rangestart)) {
	$rangestart = date("Y-m-d", $rangestart);
}
else {
	$rangestart = date("Y-m-d", strtotime($rangeend . " -7 days"));
}

// Create timestamps for the selected range.
//$rangestartTimestamp = $rangestart . " " . DAY_BEG_H . ":00:00";
//$rangeendTimestamp = $rangeend . " " . DAY_END_H . ":59:59";

pageheader(lang('searched_keywords'), "Update");
contentsection_begin(lang('searched_keywords'),true);

?>
<form method="get" action="viewsearchedkeywords.php">
	<table  border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td>Report Range:</td>
				<td><input type="textbox" name="rangestart" value="<?php echo $rangestart ?>" size="10"></td>
				<td>to</td>
				<td><input type="textbox" name="rangestart" value="<?php echo $rangeend ?>" size="10"></td>
				<td><input type="submit" value="Show"></td>
				<td> (yyyy-mm-dd)</td>
	 		</tr>
			</table>
</form>
<?php

$result =& DBquery("SELECT sum(count) as sum, keyword FROM ".TABLEPREFIX."vtcal_searchedkeywords WHERE searchdate >= '" . $rangestart . "' AND searchdate <= '" . $rangeend . "' GROUP BY keyword");

if (is_string($result)) {
	DBErrorBox($result);
}
else {
	?><table border="0" cellspacing="0" cellpadding="4">
		<tr class="TableHeaderBG">
			<td align="right"><b>Hits</b></td>
			<td><b>Keyword</b></td>
		</tr>
	<?php

	// The initial row color.
	$color = $_SESSION['COLOR_BG'];	
	
	if ($result->numRows() == 0) {
	
	}
	else {
		for ($i=0; $i < $result->numRows(); $i++) {
			$record =& $result->fetchRow(DB_FETCHMODE_ASSOC, $i);
			echo '<tr><td align="right" bgcolor="' . $color . '">' . $record['sum'] . '</td><td bgcolor="' . $color . '"><a href="#">' . $record['keyword'] . '</a></td></tr>';
			if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] ) { $color = $_SESSION['COLOR_BG']; } else { $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
		}
	}
	?></table><?php
}

contentsection_end();
pagefooter();
DBclose();
?>