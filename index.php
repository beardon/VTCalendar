<?php
if (!file_exists("config.inc.php")) {
	Header("Location: install/index.php");
	exit;
}
Header("Location: main.php");
exit;
?>