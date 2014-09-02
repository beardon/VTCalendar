<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VTCalendar Installation</title>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW"/>
<link href="styles.css" type="text/css" rel="stylesheet" />
<!--[if lt IE 7]><style type="text/css">.png { behavior: url(../scripts/png.htc); }</style><![endif]-->
</head>

<body>

<h1>VTCalendar Installation</h1>

<p style="padding: 8px; background-color: #FFEEEE; border: 1px solid #FF3333;"><font size="3"><b>Security Warning:</b></font><br />
	Once you complete the wizards below, you should remove or secure the <code>install</code> folder. </p>

<h2>Wizards</h2>

<blockquote>
	<p>There are three steps to installing VTCalendar:</p>
	<p><font size="3"><b>1. <a href="config.php">Configure VTCalendar</a></b></font></p>
	<blockquote>
		<p>Configure various VTCalendar settings including:</p>
		<ul>
			<li>Specify how to connect to the database.</li>
		    <li>Specify the URL at which the calendar is accessed. </li>
		    <li>Choose the way users authenticate. </li>
		    <li>Toggle some display features.</li>
		</ul>
	</blockquote>
	
	<p><font size="3"><b>2. <a href="upgradedb.php">Install or Upgrade  Database (MySQL Only)</a></b></font></p>
	<blockquote>
		<p>If this is a <b>fresh VTCalendar install</b> this wizard will create the necessary VTCalendar tables.</p>
	    <p>If you are <b>upgrading VTCalendar</b> this wizard will upgrade the database, adding any missing tables, columns or indexes.</p>
	</blockquote>
	
	<p><font size="3"><b>3. <a href="createadmin.php">Create Main Admin Accounts</a></b></font></p>
	<blockquote>
		<p>If this is a <b>fresh VTCalendar install</b> you may use this wizard to create main admin accounts.</p>
	</blockquote>
</blockquote>
	
<h2>Version Check</h2>

<blockquote>
	<table border="0" cellpadding="0" cellspacing="0" border="0">
		<tr>
<?php
@(include_once('../version.inc.php'));
if (!defined("VERSION")) {
	echo '<td style="padding-right: 8px;"><img src="failed32.png" class="png" width="32" height="32" alt=""/></td><td>VERSION was not defined. Make sure version.inc.php defines a constant named "VERSION" (e.g. <code>define("VERSION", 2.3.0);</code>).</td>';
}
else {
	?>
	<script type="text/javascript" src="http://vtcalendar.sourceforge.net/version.js.php"></script>
	<script type="text/javascript" src="../scripts/checkversion.js"></script>
	<script type="text/javascript">
	//<!--
	
	var InstalledVTCalendarVersion = "<?php echo VERSION; ?>";
	var Result = CheckVTCalendarVersion(InstalledVTCalendarVersion, document.LatestVTCalendarVersion);
	
	if (Result == "EQUAL") {
		document.write('<td style="padding-right: 8px;"><img src="success32.png" class="png" width="32" height="32" alt=""/></td><td>Your version of VTCalendar (' + InstalledVTCalendarVersion + ') is <b>up-to-date</b>.</td>');
	}
	else if (Result == "NEWER") {
		document.write('<td style="padding-right: 8px;"><img src="warning32.png" class="png" width="32" height="32" alt=""/></td><td>Your version of VTCalendar (' + InstalledVTCalendarVersion + ') is <b>newer than the latest release version (' + document.LatestVTCalendarVersion + ')</b>.<br/>You may be running a alpha or beta build, which are not recommended for production.</td>');
	}
	else if (Result == "OLDER") {
		document.write('<td style="padding-right: 8px;"><img src="down32.png" class="png" width="32" height="32" alt=""/></td><td>Your version of VTCalendar is ' + InstalledVTCalendarVersion + ' but a <b>newer version (' + document.LatestVTCalendarVersion + ') is available</b>.<br/>Visit <a href="http://vtcalendar.sourceforge.net/" target="_blank">http://vtcalendar.sourceforge.net/</a> for details.</td>');
	}
	else {
		document.write('<td style="padding-right: 8px;"><img src="failed32.png" class="png" width="32" height="32" alt=""/></td><td>An <b>error occurred while attempting to check for a newer version</b> of VTCalendar.<br/>Visit <a href="http://vtcalendar.sourceforge.net/" target="_blank">http://vtcalendar.sourceforge.net/</a> to manually check for a new version.</td>');
	}
	//-->
	</script>
	<?php
}
?>
		</tr>
	</table>
</blockquote>

</body>
</html>
