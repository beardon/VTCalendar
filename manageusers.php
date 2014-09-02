<?php
require_once('application.inc.php');

if (!authorized()) { exit; }
if (!$_SESSION['AUTH_ISMAINADMIN'] ) { exit; } // additional security

if (!isset($_POST['edit']) || !setVar($edit,$_POST['edit'],'edit')) unset($edit);
if (!isset($_POST['delete']) || !setVar($delete,$_POST['delete'],'delete')) unset($delete);
if (!isset($_POST['userid']) || !setVar($userid,$_POST['userid'],'userid')) unset($userid);


if ( isset($edit) ) {
	redirect2URL("changeuserinfo.php?chooseuser=1&userid=".$userid); exit;
}
elseif ( isset($delete) ) {
	redirect2URL("deleteuser.php?userid=".$userid); exit;
}

pageheader(lang('manage_users'), "Update");
contentsection_begin(lang('manage_users'),true);
?>
<form method="post" name="mainform" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<p><a href="changeuserinfo.php"><?php echo lang('add_new_user'); ?></a> <?php echo lang('or_modify_existing_user'); ?></p>

<?php
	$numLines = 15;
?>
<select name="userid" size="<?php echo $numLines; ?>" style="width:200px">
<?php

$result =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_user ORDER BY id" ); 
if (is_string($result)) {
	DBErrorBox($result);
}
else {
	for ($i=0; $i<$result->numRows(); $i++) {
		$user =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
		?><option value="<?php echo $user['id']; ?>"><?php echo $user['id']; ?></option><?php
	} // end: for ($i=0; $i<$result->numRows(); $i++)
	
	?></select><br>
	<input type="submit" name="edit" value="<?php echo lang('button_edit'); ?>">
	<input type="submit" name="delete" value="<?php echo lang('button_delete'); ?>"><br>
	<br>
	<b><?php echo $result->numRows(); ?> Users total</b>
	</form>
	<script language="JavaScript" type="text/javascript"><!--
	document.mainform.userid.focus();
	//--></script><?php
}
contentsection_end();
pagefooter();
DBclose();
?>