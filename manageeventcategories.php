<?php
require_once('application.inc.php');

if (!authorized()) { exit; }
if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

pageheader(lang('manage_event_categories'), "Update");
contentsection_begin(lang('manage_event_categories'),true);

$result =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_category WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' ORDER BY name" ); 

if (is_string($result)) {
	DBErrorBox($result); 
}
else {
	
	?><p><a href="addnewcategory.php"><?php echo lang('add_new_event_category'); ?></a><?php
	
	if ($result->numRows() > 0 ) {
		echo lang('or_modify_existing_category');
		
		?></p>
		<table border="0" cellspacing="0" cellpadding="4">
			<tr class="TableHeaderBG">
				<td><b><?php echo lang('category_name'); ?></b></td>
				<td>&nbsp;</td>
			</tr><?php
		
		$color = $_SESSION['COLOR_LIGHT_CELL_BG'];
		for ($i=0; $i<$result->numRows(); $i++) {
			$category = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] ) { $color = $_SESSION['COLOR_BG']; } else { $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
			?>	
			<tr bgcolor="<?php echo $color; ?>">
				<td bgcolor="<?php echo $color; ?>"><?php echo htmlentities($category['name']); ?></td>
				<td bgcolor="<?php echo $color; ?>"><a href="renamecategory.php?categoryid=<?php echo urlencode($category['id']); ?>"><?php echo lang('rename'); ?></a> 
			&nbsp;<a href="deletecategory.php?categoryid=<?php echo urlencode($category['id']); ?>"><?php echo lang('delete'); ?></a></td>
			</tr>
			<?php
		}
		?></table><?php
	}
}

contentsection_end();
pagefooter();
DBclose();
?>