<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Database Error</title>
<style type="text/css">
.ErrorTable {
	background-color: #FFEAEB;
	border-width: 1px;
	border-style: solid;
	border-color: #A60004;
}
.ErrorTable td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
}
.ErrorTable h1 {
	margin: 0;
	padding: 0;
	font-size: 16px;
}
</style>
</head>

<body>
<table class="ErrorTable" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td style="padding: 8px;"><img src="images/warning_48w.gif" width="48" height="48"></td>
			<td style="padding: 8px;"><h1>Database Error:</h1>
			<div>An error was encountered when attempting to connect to the database.<?php
				if (isset($DBCONNECTION) && is_string($DBCONNECTION)) {
					?><br><b><?php echo htmlentities($DBCONNECTION); ?></b><?php
				}
				if (isset($_GET['message'])) {
					?><br><b><?php echo htmlentities($_GET['message']); ?></b><?php
				}
				?></div></td>
	</tr>
</table>
</body>
</html>
