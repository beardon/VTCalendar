<?php
// Used by changeinfo.php to retrieve the sponsor name/url via an XMLHTTPRequest without having to reload the whole page.

require_once('application.inc.php');

if (!isset($_GET['sponsorid']) || !setVar($sponsorid,$_GET['sponsorid'],'sponsorid')) unset($sponsorid);
if (isset($_GET['type'])) { $type = $_GET['type']; } else { unset($type); }

if (!isset($sponsorid)) {
	echo "INVALID_SPONSOR_ID:", $_GET['sponsorid'];
}
else {
	$result =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_sponsor WHERE id='".sqlescape($sponsorid)."'" );
	if (is_string($result)) {
		echo "ERROR:" . $result;
	}
	else {
		if ($result->numRows() == 0) {
			echo "SPONSOR_ID_NOTFOUND:", $_GET['sponsorid'];
		}
		else {
			$sponsor =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
			if ($type == "name") {
				echo $sponsor['name'];
			}
			elseif ($type == "url") {
				echo $sponsor['url'];
			}
		}
	}
}
?>