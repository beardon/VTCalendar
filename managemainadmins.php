<?php
require_once('application.inc.php');

if (!authorized()) { exit; }
if (!$_SESSION['AUTH_ISMAINADMIN']) { exit; } // additional security

pageheader(lang('manage_main_admins'), "Update");
contentsection_begin(lang('manage_main_admins'),true);

$result =& DBQuery("SELECT * FROM ".SCHEMANAME."vtcal_adminuser ORDER BY id" ); 

if (is_string($result))	{
	DBErrorBox($result);
}
else {
	?>
	<form method="post" name="mainform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<p><a href="addmainadmin.php"><?php echo lang('add_new_main_admin'); ?></a> <?php echo lang('or_delete_existing'); ?></p>
	
	<table border="0" cellspacing="0" cellpadding="4">
		<tr class="TableHeaderBG">
			<td><b><?php echo lang('user_id'); ?></b></td>
			<td>&nbsp;</td>
		</tr>
	<?php
	
		$color = $_SESSION['COLOR_LIGHT_CELL_BG'];
		for ($i=0; $i<$result->numRows(); $i++) {
			$user =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			if ( $color == $_SESSION['COLOR_LIGHT_CELL_BG'] ) { $color = $_SESSION['COLOR_BG']; } else { $color = $_SESSION['COLOR_LIGHT_CELL_BG']; }
			?>	
			<tr bgcolor="<?php echo $color; ?>">
				<td bgcolor="<?php echo $color; ?>"><?php echo htmlentities($user['id']); ?></td>
				<td bgcolor="<?php echo $color; ?>"><a href="deletemainadmin.php?mainuserid=<?php echo urlencode($user['id']); ?>"><?php echo lang('delete'); ?></a></td>
			</tr>
			<?php
		} // end: for ($i=0; $i<$result->numRows(); $i++)
	?>	
	</table>
	<br>
	<b><?php echo $result->numRows(); ?> <?php echo lang('main_admins_total'); ?></b>
	</form>
	<?php
}
contentsection_end();
pagefooter();
DBclose();
?>