<?php
  if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

	function pageheader($title, $headline, $navbaractive, $calendarnavbar, $database) {
	  global $enableViewMonth;
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta content="en-us" http-equiv=language>
    <meta content="Jochen Rode" http-equiv=author>
    <meta content="Web Hosting Group, Virginia Tech" http-equiv=publisher>
    <link href="stylesheet.php" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/javascript"><!--
		function isIE4()
		{ return( navigator.appName.indexOf("Microsoft") != -1 && (navigator.appVersion.charAt(0)=='4') ); }
		
		function new_window(freshurl) {
			SmallWin = window.open(freshurl, 'Calendar','scrollbars=yes,resizable=yes,toolbar=no,height=300,width=400');
			if (!isIE4())	{
				if (window.focus) { SmallWin.focus(); }
			}
			if (SmallWin.opener == null) SmallWin.opener = window;
			SmallWin.opener.name = "Main";
		}
		//-->
		</script>
  </head>
  <body bgcolor="<?php echo $_SESSION["BGCOLOR"]; ?>" leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
<?php 
    echo $_SESSION["HEADER"];
    require("topnavbar.inc.php"); 
  } // function pageheader;
?>