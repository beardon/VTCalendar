<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files
	
?><table width="100%" border="0" cellpadding="0" cellspacing="10"><tr><td><?php
echo lang('subscribe_message');

$color = $_SESSION['COLOR_BG'];
$iCalDirName = 'calendars/';

?>
<h3><b><?php echo lang('whole_calendar'); ?>:</b></h3>

<blockquote>
<table border="0" cellspacing="2" cellpadding="0">
<?php

echo '<tr><td><b style="font-size: 14px;">'.htmlentities($_SESSION['CALENDAR_NAME']) . '</b></td></tr>';

if (CACHE_SUBSCRIBE_LINKS && $_SESSION['CALENDAR_VIEWAUTHREQUIRED'] == 0) {
	?><tr><td>
	<a href="<?php echo BASEURL . CACHE_SUBSCRIBE_LINKS_PATH . htmlentities($_SESSION['CALENDAR_ID']) . '.xml'; ?>"><?php echo lang('rss_feed'); ?></a> &nbsp;
	<a href="webcal://<?php echo preg_replace('/^[A-Za-z]+:\/\//', '', BASEURL) . CACHE_SUBSCRIBE_LINKS_PATH . htmlentities($_SESSION['CALENDAR_ID']) . '.ics'; ?>"><?php echo lang('subscribe'); ?></a> &nbsp;
	<a href="<?php echo BASEURL . CACHE_SUBSCRIBE_LINKS_PATH . htmlentities($_SESSION['CALENDAR_ID']) . '.ics'; ?>"><?php echo lang('download'); ?></a>
	</td></tr><?php
}
else {
	?><tr><td>
	<a href="<?php echo BASEURL . EXPORT_PATH; ?>?calendar=<?php echo urlencode($_SESSION['CALENDAR_ID']); ?>&format=rss2_0&timebegin=upcoming"><?php echo lang('rss_feed'); ?></a> &nbsp;
	<a href="webcal://<?php echo preg_replace('/^[A-Za-z]+:\/\//', '', BASEURL) . EXPORT_PATH; ?>?calendar=<?php echo urlencode($_SESSION['CALENDAR_ID']); ?>&format=ical&timebegin=upcoming"><?php echo lang('subscribe'); ?></a> &nbsp;
	<a href="<?php echo BASEURL . EXPORT_PATH; ?>?calendar=<?php echo urlencode($_SESSION['CALENDAR_ID']); ?>&format=ical&timebegin=upcoming"><?php echo lang('download'); ?></a>
	</td></tr><?php
}

// Get the categories from the DB
$result =& DBQuery("SELECT count(*) as eventcount FROM ".SCHEMANAME."vtcal_category WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."'"); 
if (!is_string($result)) {
	$record =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	echo '<tr><td>'.str_replace("<br/>", " ", lang('upcoming_events')).': '.$record['eventcount'].'</td></tr>';
	$result->free();
}

?>
</table>
</blockquote>

<?php

?><h3><b>...or by category:</b></h3>
	<blockquote>
		<table border="0" cellspacing="2" cellpadding="4">
			<tr bgcolor="<?php echo $color; ?>">
				<td bgcolor="<?php echo $_SESSION['COLOR_TABLE_HEADER_BG']; ?>"><b><?php echo lang('category'); ?></b></td>
				<td align="right" bgcolor="<?php echo $_SESSION['COLOR_TABLE_HEADER_BG']; ?>"><b><?php echo lang('upcoming_events'); ?></b></td>
				<td align="center" bgcolor="<?php echo $_SESSION['COLOR_TABLE_HEADER_BG']; ?>"><b><?php echo lang('ways_to_subscribe'); ?></b></td>
			</tr>

<?php
// Get the categories from the DB
$result =& DBQuery("SELECT count(e.id) as eventcount, c.id, c.name FROM ".SCHEMANAME."vtcal_category c LEFT JOIN ".SCHEMANAME."vtcal_event_public e ON c.calendarid = e.calendarid AND c.id = e.categoryid AND e.timeend > '" . sqlescape(NOW_AS_TEXT) . "' WHERE c.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' GROUP BY c.id ORDER BY c.name"); 
if (is_string($result)) {
	DBErrorBox($result); 
}
else {
	for ($i=0; $i<$result->numRows(); $i++) {
		$category =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
		if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] ) { $color = $_SESSION['COLOR_BG']; } else { $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
		?>	
		<tr bgcolor="<?php echo $color; ?>">
			<td bgcolor="<?php echo $color; ?>"><?php echo htmlentities($category['name']); ?></td>
			<td align="right" bgcolor="<?php echo $color; ?>"><?php echo $category['eventcount']; ?></td>
			<td bgcolor="<?php echo $color; ?>">
				<?php if (CACHE_SUBSCRIBE_LINKS) {
					?>
					<a href="<?php echo BASEURL . CACHE_SUBSCRIBE_LINKS_PATH . htmlentities($_SESSION['CALENDAR_ID']) . '_' . htmlentities($category['id']) . '.xml'; ?>"><?php echo lang('rss_feed'); ?></a> &nbsp;
					<a href="webcal://<?php echo preg_replace('/^[A-Za-z]+:\/\//', '', BASEURL) . CACHE_SUBSCRIBE_LINKS_PATH . htmlentities($_SESSION['CALENDAR_ID']) . '_' . htmlentities($category['id']) . '.ics'; ?>"><?php echo lang('subscribe'); ?></a> &nbsp;
					<a href="<?php echo BASEURL . CACHE_SUBSCRIBE_LINKS_PATH . htmlentities($_SESSION['CALENDAR_ID']) . '_' . htmlentities($category['id']) . '.ics'; ?>"><?php echo lang('download'); ?></a>
					<?php
				}
				else {
					?>
					<a href="<?php echo BASEURL . EXPORT_PATH; ?>?calendar=<?php echo urlencode($_SESSION['CALENDAR_ID']); ?>&format=rss2_0&timebegin=upcoming&categories=<?php echo $category['id']; ?>"><?php echo lang('rss_feed'); ?></a> &nbsp;
					<a href="webcal://<?php echo preg_replace('/^[A-Za-z]+:\/\//', '', BASEURL) . EXPORT_PATH; ?>?calendar=<?php echo urlencode($_SESSION['CALENDAR_ID']); ?>&format=ical&timebegin=upcoming&categories=<?php echo $category['id']; ?>"><?php echo lang('subscribe'); ?></a> &nbsp;
					<a href="<?php echo BASEURL . EXPORT_PATH; ?>?calendar=<?php echo urlencode($_SESSION['CALENDAR_ID']); ?>&format=ical&timebegin=upcoming&categories=<?php echo $category['id']; ?>"><?php echo lang('download'); ?></a>
					<?php
				}
				?>
			</td>
		</tr>
		<?php
	}
}

?></blockquote></table>

</td></tr></table>