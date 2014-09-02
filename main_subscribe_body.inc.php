<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files
	
?><table width="100%" border="0" cellpadding="0" cellspacing="10"><tr><td><?php
echo "<p>" . lang('subscribe_message') . "</p>";

$color = $_SESSION['COLOR_BG'];
$iCalDirName = 'calendars/';

// Output a list of static ICS files if they exist.
if (is_dir($iCalDirName) && $iCalDir = opendir($iCalDirName)) {
	echo '<table border="0" cellspacing="0" cellpadding="4">';

	/* This is the correct way to loop over the directory. */
	while ( ($file = readdir($iCalDir)) != false) {
		if (strlen($file)>4 && substr($file,strlen($file)-4,4)==".ics") {
			if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] ) { $color = $_SESSION['COLOR_BG']; } else { $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
			?>	
			<tr bgcolor="<?php echo $color; ?>">
				<td bgcolor="<?php echo $color; ?>"><?php echo substr($file,0,strlen($file)-4); ?></td>
				<td bgcolor="<?php echo $color; ?>"><a href="webcal://<?php echo substr(BASEURL,7).$iCalDirName.$file; ?>"><?php echo lang('subscribe'); ?></a> &nbsp; 
			<a href="<?php echo BASEURL.$iCalDirName.$file; ?>"><?php echo lang('download'); ?></a></td>
			</tr>
			<?php
		}
	} 
	echo '</table>';
	closedir($iCalDir);
}

// Otherwise, output links to generate ICS files dynamically.
else { 
	$result =& DBQuery("SELECT * FROM vtcal_category WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' ORDER BY name" ); 
	if (is_string($result)) {
		DBErrorBox($result); 
	}
	else {
		echo '<table border="0" cellspacing="0" cellpadding="4">';
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
		echo '</table>';
	}
}

?>
<br>
&nbsp;<?php echo $_SESSION['CALENDAR_NAME']; ?> (<?php echo lang('whole_calendar'); ?>)&nbsp; 
<a href="webcal://<?php echo substr(BASEURL,7); ?>export.php?calendar=<?php echo $_SESSION['CALENDAR_ID']; ?>&type=ical&sponsortype=all&timebegin=today"><?php echo lang('subscribe'); ?></a> &nbsp; 
<a href="<?php echo BASEURL; ?>export.php?type=ical&sponsortype=all&timebegin=today"><?php echo lang('download'); ?></a>

</td></tr></table>