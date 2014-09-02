<?php
@(include_once('config.inc.php')) or die('config.inc.php was not found. See: <a href="install/">VTCalendar Configuration</a> installer.');
require_once('config-defaults.inc.php');
require_once('config-colordefaults.inc.php');

if (BASEPATH != "" && BASEDOMAIN != "") {
	session_set_cookie_params(0, BASEPATH, BASEDOMAIN);
}
else {
	session_set_cookie_params(0);
}

session_name("VTCAL");
session_start();
?>