<?php
require_once('application.inc.php');

	if (!isset($_GET['templateid']) || !setVar($templateid,$_GET['templateid'],'templateid')) unset($templateid);

	if (!authorized()) { exit; }

	if (!empty($templateid)) {
		$result = DBQuery("DELETE FROM ".TABLEPREFIX."vtcal_template WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND sponsorid='".sqlescape($_SESSION["AUTH_SPONSORID"])."' AND id='".sqlescape($templateid)."'" );
	}

	redirect2URL("managetemplates.php");
	exit;
?>