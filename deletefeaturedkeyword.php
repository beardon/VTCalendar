<?php
require_once('application.inc.php');

	if (!isset($_GET['id']) || !setVar($id,$_GET['id'],'searchkeywordid')) unset($id);

	if (!authorized()) { exit; }
	if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

	$query = "DELETE FROM ".SCHEMANAME."vtcal_searchfeatured WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($id)."'";
	$result = DBQuery($query );
	redirect2URL("managefeaturedsearchkeywords.php");
	exit;
?>