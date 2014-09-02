<?php
if (!file_exists("config.inc.php")) {
	Header("Location: install/index.php");
	exit;
}

//  $serverpath = $GLOBALS["SCRIPT_URI"];
//  if ($serverpath[strlen($serverpath)]!="/") { 
//    $serverpath = substr($serverpath,0,strrpos($serverpath,"/")+1); 
//  }
//  Header("Location: ".$serverpath."main.php");
Header("Location: main.php");
exit;
?>