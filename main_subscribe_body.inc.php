<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files
	
?><table width="100%" border="0" cellpadding="0" cellspacing="10"><tr><td><?php
echo "<p>" . lang('subscribe_message') . "</p>";

$color = $_SESSION['COLOR_BG'];
$iCalDirName = 'calendars/';

?>
<b><?php echo lang('whole_calendar'); ?>:</b><br/><?php echo $_SESSION['CALENDAR_NAME']; ?>&nbsp; 
<a href="webcal://<?php echo substr(BASEURL,7); ?>export.php?calendar=<?php echo $_SESSION['CALENDAR_ID']; ?>&type=ical&sponsortype=all&timebegin=today"><?php echo lang('subscribe'); ?></a> &nbsp; 
<a href="<?php echo BASEURL; ?>export.php?type=ical&sponsortype=all&timebegin=today"><?php echo lang('download'); ?></a>
<?php

echo '<p><b>...or by category:</b></p><blockquote><table border="0" cellspacing="0" cellpadding="4">';

// The number of ICS files found.
$fileCount = 0;
	
// Output a list of static ICS files if they exist.
if (is_dir($iCalDirName) && $iCalDir = opendir($iCalDirName)) {
	/* This is the correct way to loop over the directory. */
	while ( ($file = readdir($iCalDir)) != false) {
		if (strlen($file)>4 && substr($file,strlen($file)-4,4)==".ics") {
			if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] ) { $color = $_SESSION['COLOR_BG']; } else { $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
			?>	
			<tr bgcolor="<?php echo $color; ?>">
				<td bgcolor="<?php echo $color; ?>"><?php echo htmlentities(substr($file,0,strlen($file)-4)); ?></td>
				<td bgcolor="<?php echo $color; ?>"><a href="webcal://<?php echo substr(BASEURL,7).$iCalDirName.htmlentities($file); ?>"><?php echo lang('subscribe'); ?></a> &nbsp; 
			<a href="<?php echo BASEURL.$iCalDirName.htmlentities($file); ?>"><?php echo lang('download'); ?></a></td>
			</tr>
			<?php
			$fileCount++;
		}
	}
	
	closedir($iCalDir);
}

// Get the categories from the DB if no files were found (or if we never searched for files anyway).
if ($fileCount == 0) {
	$result =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_category WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' ORDER BY name" ); 
	if (is_string($result)) {
		DBErrorBox($result); 
	}
	else {
		for ($i=0; $i<$result->numRows(); $i++) {
			$category =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] ) { $color = $_SESSION['COLOR_BG']; } else { $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
			?>	
			<tr bgcolor="<?php echo $color; ?>">
				<td bgcolor="<?php echo $color; ?>"><?php echo $category['name']; ?></td>
				<td bgcolor="<?php echo $color; ?>"><a href="webcal://<?php echo substr(BASEURL,7); ?>export.php?calendar=<?php echo $_SESSION['CALENDAR_ID']; ?>&type=ical&sponsortype=all&timebegin=today&categoryid=<?php echo $category['id']; ?>"><?php echo lang('subscribe'); ?></a> &nbsp; 
			<a href="<?php echo BASEURL; ?>export.php?type=ical&sponsortype=all&timebegin=today&categoryid=<?php echo $category['id']; ?>"><?php echo lang('download'); ?></a></td>
			</tr>
			<?php
		}
	}
}

echo '</blockquote></table>';

?>
</td></tr></table>