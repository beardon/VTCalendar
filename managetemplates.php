<?php
require_once('application.inc.php');

if (!authorized()) { exit; }

pageheader(lang('manage_templates'), "Update");
contentsection_begin(lang('manage_templates'), true);

$result =& DBQuery("SELECT * FROM vtcal_template WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND sponsorid='".sqlescape($_SESSION["AUTH_SPONSORID"])."' ORDER BY name" ); 
if (is_string($result)) {
	DBErrorBox($result);
}
else {
	?><p><a href="addtemplate.php"><?php echo lang('add_new_template'); ?></a><?php
	
	if ($result->numRows() > 0 ) {
		echo lang('or_modify_existing_template'); ?></p>
		
		<table border="0" cellspacing="0" cellpadding="4">
			<tr class="TableHeaderBG">
				<td><b><?php echo lang('template_name'); ?></b></td>
				<td>&nbsp;</td>
			</tr>
		<?php
		
		$color = $_SESSION['COLOR_LIGHT_CELL_BG'];
		for ($i=0; $i<$result->numRows(); $i++) {
			$template = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] ) { $color = $_SESSION['COLOR_BG']; } else { $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
			?>	
			<tr bgcolor="<?php echo $color; ?>">
				<td bgcolor="<?php echo $color; ?>"><?php echo htmlentities($template['name']); ?></td>
				<td bgcolor="<?php echo $color; ?>"><a href="updatetinfo.php?templateid=<?php echo urlencode($template['id']); ?>"><?php echo lang('edit'); ?></a> 
			&nbsp;<a href="deletetemplate.php?templateid=<?php echo urlencode($template['id']); ?>"><?php echo lang('delete'); ?></a></td>
			</tr>
			<?php
		} // end: for ($i=0; $i<$result->numRows(); $i++)
		
		?></table><br><?php
	} // end: if ($result->numRows() > 0 )
}
contentsection_end();
pagefooter();
DBclose();
?>