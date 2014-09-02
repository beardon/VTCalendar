<?php
require_once('application.inc.php');

if (!authorized()) { exit; }
if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

pageheader(lang('manage_featured_search_keywords'), "Update");
contentsection_begin(lang('manage_featured_search_keywords'),true);

$result =& DBQuery("SELECT * FROM vtcal_searchfeatured WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' ORDER BY keyword" ); 

if (is_string($result)) {
	DBErrorBox($result); 
}
else {
	?>
	<p><?php echo lang('featured_search_keywords_message'); ?><p>
	
	<p><a href="editfeaturedkeyword.php"><?php echo lang('add_new_featured_keyword'); ?></a>
	<?php
		if ($result->numRows() > 0 ) {
	?>
	<?php echo lang('or_manage_existing_keywords'); ?></p>
	
	<table border="0" cellspacing="0" cellpadding="4">
		<tr class="TableHeaderBG">
			<td><b><?php echo lang('keyword'); ?></b></td>
			<td>&nbsp;</td>
		</tr>
	<?php
		$color = $_SESSION['COLOR_LIGHT_CELL_BG'];
		for ($i=0; $i<$result->numRows(); $i++) {
			$searchkeyword =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] ) { $color = $_SESSION['COLOR_BG']; } else { $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
	?>	
		<tr bgcolor="<?php echo $color; ?>">
			<td bgcolor="<?php echo $color; ?>"><?php echo htmlentities($searchkeyword['keyword']); ?></td>
			<td bgcolor="<?php echo $color; ?>">&nbsp;<a href="editfeaturedkeyword.php?id=<?php echo urlencode($searchkeyword['id']); ?>"><?php echo lang('edit'); ?></a>&nbsp;&nbsp; 
		<a href="deletefeaturedkeyword.php?id=<?php echo urlencode($searchkeyword['id']); ?>"><?php echo lang('delete'); ?></a></td>
		</tr>
	<?php
		} // end: for ($i=0; $i<$result->numRows(); $i++)
	?>	
	</table>
	
	<?php
	} // end: if ($result->numRows() > 0 )
}
contentsection_end();
pagefooter();
DBclose();
?>