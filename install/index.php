<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VTCalendar Installation</title>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW"/>
<link href="styles.css" type="text/css" rel="stylesheet" />
<!--[if lt IE 7]><style type="text/css">.png { behavior: url(../scripts/iepngfix.htc); }</style><![endif]-->
<style type="text/css">
#ReleaseNote {
	padding-top: 4px;
}
#ReleaseMessage {
	padding-bottom: 16px;
}
#PreReleaseNote {
	padding-top: 8px;
}
</style>
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
	<div id="VersionResult"></div>
	<script type="text/javascript"><!-- //<![CDATA[
	function CheckVersionHandler(image, messageHTML, tableHTML) {
		document.getElementById("VersionResult").innerHTML = tableHTML.replace(/src="/g, 'src="../'); //'<table border="0" cellpadding="0" cellspacing="0" border="0"><tr><td valign="top" style="padding-top: 4px; padding-right: 8px;"><img src="../'+image+'" class="png" width="32" height="32" alt=""/></td><td width="100%">'+messageHTML+'</td></tr></table>';
	}	
	// ]]> --></script>
	<iframe src="../checkversion.php" width="1" height="1" frameborder="0" marginheight="0" marginwidth="0" allowtransparency="true"></iframe>
</blockquote>

</body>
</html>
