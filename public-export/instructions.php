<?php
define("ALLOWINCLUDES", TRUE); // Allows this file to include other files (e.g. config.inc.php).
@(include_once('../config.inc.php')) or die('config.inc.php was not found. See: <a href="../install/">VTCalendar Configuration</a> installer.');
require_once('../config-defaults.inc.php');
require_once('../constants.inc.php');
require_once('../functions.inc.php');
require_once('functions.inc.php');
require_once('defaults_and_constants.inc.php');

$errors = 0;

// If the query string is passing a valid CalendarID, set it to a variable.
if ( isset($_GET['calendarid']) && isValidInput($_GET['calendarid'],'calendarid') )
	{ $config['CalendarID'] = $_GET['calendarid']; }
elseif ( isset($_GET['calendar']) && isValidInput($_GET['calendar'],'calendarid') ) 
	{ $config['CalendarID'] = $_GET['calendar']; }

// Otherwise, the CalendarID is missing or invalid
else { $errors++; $error[$errors] = "The CalendarID was not specified or is invalid."; }

// Override default values with variables being set in the query string.
// Output an error message if any of the input values is invalid.
if ( isset($_GET['maxevents']) && $_GET['maxevents'] != "" ) { if ( isValidRemoteInput($_GET['maxevents'], 'MAXEVENTS') ) { $config['MaxEvents'] = intval($_GET['maxevents']); } else { $errors++; $error[$errors] = "The value of 'Maximum Events Returned' is invalid."; } } //else { unset($config['MaxEvents']); }
if ( isset($_GET['maxtitlecharacters']) && $_GET['maxtitlecharacters'] != "" ) { if ( isValidRemoteInput($_GET['maxtitlecharacters'], 'MAXTITLECHARACTERS') ) { $config['MaxTitleCharacters'] = intval($_GET['maxtitlecharacters']); } else { $errors++; $error[$errors] = "The value of 'Maximum Characters for the Title' is invalid."; } } //else { unset($config['MaxTitleCharacters']); }
if ( isset($_GET['maxlocationcharacters']) && $_GET['maxlocationcharacters'] != "" ) { if ( isValidRemoteInput($_GET['maxlocationcharacters'], 'MAXLOCATIONCHARACTERS') ) { $config['MaxLocationCharacters'] = intval($_GET['maxlocationcharacters']); } else { $errors++; $error[$errors] = "The value of 'Maximum Characters for the Location' is invalid."; } } //else { unset($config['MaxLocationCharacters']); }
if ( isset($_GET['javascript']) && $_GET['javascript'] != "" ) { if ( isValidRemoteInput($_GET['javascript'], 'JAVASCRIPT') ) { $config['JavaScript'] = substr(strtoupper($_GET['javascript']),0,1); } else { $errors++; $error[$errors] = "The value of 'Use JavaScript' is invalid."; } } //else { unset($config['JavaScript']); }
if ( isset($_GET['datatype']) && $_GET['datatype'] != "" ) { if ( isValidRemoteInput($_GET['datatype'], 'DATATYPE') ) { $config['DataType'] = strtoupper($_GET['datatype']); } else { $errors++; $error[$errors] = "The value of 'Type of Data Returned' is invalid."; } } //else { unset($config['DataType']); }
if ( isset($_GET['htmltemplate']) && $_GET['htmltemplate'] != "" ) { if ( isValidRemoteInput($_GET['htmltemplate'], 'HTMLTEMPLATE') ) { $config['HTMLTemplate'] = strtoupper($_GET['htmltemplate']); } else { $errors++; $error[$errors] = "The value of 'HTML Template' is invalid."; } } //else { unset($config['HTMLTemplate']); }
if ( isset($_GET['dateformat']) && $_GET['dateformat'] != "" ) { if ( isValidRemoteInput($_GET['dateformat'], 'DATEFORMAT') ) { $config['DateFormat'] = strtoupper($_GET['dateformat']); } else { $errors++; $error[$errors] = "The value of 'Date Format' is invalid."; } } //else { unset($config['DateFormat']); }
if ( isset($_GET['timedisplay']) && $_GET['timedisplay'] != "" ) { if ( isValidRemoteInput($_GET['timedisplay'], 'TIMEDISPLAY') ) { $config['TimeDisplay'] = strtoupper($_GET['timedisplay']); } else { $errors++; $error[$errors] = "The value of 'Time Display' is invalid."; } } //else { unset($config['TimeDisplay']); }
if ( isset($_GET['timeformat']) && $_GET['timeformat'] != "" ) { if ( isValidRemoteInput($_GET['timeformat'], 'TIMEFORMAT') ) { $config['TimeFormat'] = strtoupper($_GET['timeformat']); } else { $errors++; $error[$errors] = "The value of 'Time Format' is invalid."; } } //else { unset($config['TimeFormat']); }
if ( isset($_GET['durationformat']) && $_GET['durationformat'] != "" ) { if ( isValidRemoteInput($_GET['durationformat'], 'DURATIONFORMAT') ) { $config['DurationFormat'] = strtoupper($_GET['durationformat']); } else { $errors++; $error[$errors] = "The value of 'Duration Format' is invalid."; } } //else { unset($config['DurationFormat']); }
if ( isset($_GET['filterby']) && $_GET['filterby'] != "" ) { if ( isValidRemoteInput($_GET['filterby'], 'FILTERBY') ) { $config['FilterBy'] = $_GET['filterby']; } else { $errors++; $error[$errors] = "The value of 'Category Filters' is invalid."; } } //else { unset($config['FilterBy']); }
if ( isset($_GET['linkfilter']) && $_GET['linkfilter'] != "" ) { if ( isValidRemoteInput($_GET['linkfilter'], 'LINKFILTER') ) { $config['LinkFilter'] = $_GET['linkfilter']; } else { $errors++; $error[$errors] = "The value of 'Hyperlink Category Filters' is invalid."; } } //else { unset($config['LinkFilter']); }
if ( isset($_GET['showdatetime']) && $_GET['showdatetime'] != "" ) { if ( isValidRemoteInput($_GET['showdatetime'], 'SHOWDATETIME') ) { $config['ShowDateTime'] = substr(strtoupper($_GET['showdatetime']),0,1); } else { $errors++; $error[$errors] = "The value of 'show Date and Time' is invalid."; } } //else { unset($config['ShowDateTime']); }
if ( isset($_GET['showlocation']) && $_GET['showlocation'] != "" ) { if ( isValidRemoteInput($_GET['showlocation'], 'SHOWLOCATION') ) { $config['ShowLocation'] = substr(strtoupper($_GET['showlocation']),0,1); } else { $errors++; $error[$errors] = "The value of 'show Location' is invalid."; } } //else { unset($config['ShowLocation']); }
if ( isset($_GET['showallday']) && $_GET['showallday'] != "" ) { if ( isValidRemoteInput($_GET['showallday'], 'SHOWALLDAY') ) { $config['ShowAllDay'] = substr(strtoupper($_GET['showallday']),0,1); } else { $errors++; $error[$errors] = "The value of 'Show All Day' is invalid."; } } //else { unset($config['ShowAllDay']); }
if ( isset($_GET['combinerepeating']) && $_GET['combinerepeating'] != "" ) { if ( isValidRemoteInput($_GET['combinerepeating'], 'COMBINEREPEATING') ) { $config['CombineRepeating'] = substr(strtoupper($_GET['combinerepeating']),0,1); } else { $errors++; $error[$errors] = "The value of 'Combine Repeating' is invalid."; } } //else { unset($config['CombineRepeating']); }

// You cannot output XML using JavaScript, so turn JavaScript off it that combination was selected.
if ($config['DataType'] == "XML" && $config['JavaScript'] == "Y") {
	$config['JavaScript'] = "N";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Guide to Using the Standard Template - Howard University</title>
<link href="standard.css" rel="stylesheet" type="text/css">
<link href="standardfonts.css" rel="stylesheet" type="text/css">
<style type="text/css" media="screen">
<!--
body {
	background-color: #D4D0C8;
}
#BodyContainer {
	background-color: #FFFFFF;
	width: 742px;
	border: 1px solid #666666;
	padding: 16px;
}
-->
</style>
<style type="text/css" media="print">
#PageNavi {
	display: none;
}
</style>
<style type="text/css">
<!--
form {
	margin: 0;
	padding: 0;
}
h1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 22px;
	padding-top: 0;
	margin-top: 0;
	padding-bottom: 8px;
	border-bottom: 2px solid #666666;
}
h2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #0066CC;
	padding-bottom: 8px;
	border-bottom: 1px solid #999999;
}
h3 {
	font-size: 16px;
	color: #006600;
}
h4 {
	font-size: 14px;
	color: #666666;
}
blockquote {
	padding: 0;
	margin: 0;
	margin-right: 0;
	padding-right: 0;
	margin-left: 25px;
}
p.ListHeader, h1.ListHeader, h2.ListHeader, h3.ListHeader {
	padding-bottom: 3px;
	margin-bottom: 0;
}
ul.HeadedList, ol.HeadedList {
	padding-top: 3px;
	margin-top: 0;
}
-->
</style>
</head>

<body link="#0000FF" vlink="#0000FF">
<table border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td id="BodyContainer">
<!-- Begin Body -->
<h1 align="center">Calendar Export</h1>

<?php
if ($errors == 0 && isset($_GET['createexport']) && $_GET['createexport'] != "") {
	$QueryString = "";
	if (isset($config['MaxEvents'])) { $QueryString = $QueryString.'&maxevents='.urlencode($config['MaxEvents']); }
	if (isset($config['MaxTitleCharacters'])) { $QueryString = $QueryString.'&maxtitlecharacters='.urlencode($config['MaxTitleCharacters']); }
	if (isset($config['MaxLocationCharacters'])) { $QueryString = $QueryString.'&maxlocationcharacters='.urlencode($config['MaxLocationCharacters']); }
	if (isset($config['JavaScript'])) { $QueryString = $QueryString.'&javascript='.urlencode($config['JavaScript']); }
	if (isset($config['DataType'])) { $QueryString = $QueryString.'&datatype='.urlencode($config['DataType']); }
	if (isset($config['HTMLTemplate'])) { $QueryString = $QueryString.'&htmltemplate='.urlencode($config['HTMLTemplate']); }
	if (isset($config['DateFormat'])) { $QueryString = $QueryString.'&dateformat='.urlencode($config['DateFormat']); }
	if (isset($config['TimeDisplay'])) { $QueryString = $QueryString.'&timedisplay='.urlencode($config['TimeDisplay']); }
	if (isset($config['TimeFormat'])) { $QueryString = $QueryString.'&timeformat='.urlencode($config['TimeFormat']); }
	if (isset($config['DurationFormat'])) { $QueryString = $QueryString.'&durationformat='.urlencode($config['DurationFormat']); }
	if (isset($config['FilterBy'])) { $QueryString = $QueryString.'&filterby='.urlencode($config['FilterBy']); }
	if (isset($config['LinkFilter'])) { $QueryString = $QueryString.'&linkfilter='.urlencode($config['LinkFilter']); }
	if (isset($config['ShowDateTime'])) { $QueryString = $QueryString.'&showdatetime='.urlencode($config['ShowDateTime']); }
	if (isset($config['ShowLocation'])) { $QueryString = $QueryString.'&showlocation='.urlencode($config['ShowLocation']); }
	if (isset($config['ShowAllDay'])) { $QueryString = $QueryString.'&showallday='.urlencode($config['ShowAllDay']); }
	if (isset($config['CombineRepeating'])) { $QueryString = $QueryString.'&combinerepeating='.urlencode($config['CombineRepeating']); }
	$FullURL = BASEURL.'public-export/?calendarid='.urlencode($config['CalendarID']).$QueryString;
	
	echo '<form method="post" action="instructions.php?calendarid='.urlencode($config['CalendarID']).$QueryString.'" onSubmit="location.href=this.action; return false;"><p><input type="Submit" value="&lt;&lt; Return to the Form"></p></form>';
	
	echo '<form name="form1" method="post" action="">';
	echo '<p><b>Copy the URL/HTML:</b> (Click inside the box below and press CTRL-C)<br><input type="text" style="width: 640px; margin-top:4px;" onFocus="this.select();" onClick="this.select(); this.focus();" value="';
	
	if ($config['JavaScript'] == "Y") {
		echo htmlentities('<script type="text/javascript" src="'.$FullURL.'"></script>');
	}
	else {
		echo htmlentities($FullURL);
	}
	
	echo '" size="70" readonly="readonly"></p>';
	echo '<p><b>Output Preview:</b><br><iframe style="margin-top: 4px;" src="'.preg_replace("/&javascript=[YESNO]+/i","",$FullURL).'&javascript=n" width="100%" height="400" framebordder="1"><p><a href="'.$FullURL.'" target="_blank">Test the URL</a></p></iframe></p>';
	echo '<p><b>HTML Preview:</b><br><iframe style="margin-top: 4px;" src="'.preg_replace("/&javascript=[YESNO]+/i","",$FullURL).'&javascript=n&plaintext=y" width="100%" height="400" framebordder="1"><p><a href="'.$FullURL.'" target="_blank">Test the URL</a></p></iframe></p>';
	echo '</form>';
}
else {
?>

<p>The Calendar Export feature allows you to display upcoming events directly on your Web site, without requiring any programming. If you know CSS, it is easy to customize the way the upcoming events display.</p>

<h2>Basic Instructions:</h2>
<ol class="listpadding">
	<li>Complete the &quot;Basic Settings&quot; part of the form below.</li>
	<li>Click &quot;Create the Export URL/HTML&quot;</li>
	<li>Check the &quot;Output Preview&quot; box to make sure the events are displaying correctly.<br><i>Note: If you have no events in your calendar, a message will display saying this.</i></p>
	<li>Follow the instructions to copy the HTML.</li>
	<li>Paste the HTML you copied into your Web site where you want the upcoming events to display.</li>
	<li>View your Web site to make sure the events are displaying correctly.</li>
</ol>
<h2>Setting up the export:</h2>
<form name="form2" method="get" action="instructions.php">
<?php
if ($errors > 0 && isset($_GET['createexport']) && $_GET['createexport'] != "") {
	echo '<table border="0" cellpadding="10" cellspacing="0" bgcolor="#FFCCCC" style="border: 2px solid #990000;"><tr><td><p><font color="#990000"><b>Some errors were found with the information you entered:</b></font></p><ul>';
	for ($i = 1; $i <= $errors; $i++) {
		echo "<li>".$error[$i]."</li>";
	}
	echo "</ul></td></tr></table>";
}
?>
<h3>Basic Settings:</h3>

<div style="padding-left: 20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="10" style="background-color: #EEEEEE; border-left: 4px solid #999999;"><tr><td>

<p>The following basic settings are all you need to complete in order to export calendar information to your Web site.</p>

<p><b>Calendar ID:</b></p>
<blockquote>
	<p>To determine your calendar ID do the following:</p>
	<ol class="listpadding">
		<li>View your <a href="http://www.howard.edu/calendar/documents/allcalendars.htm" target="_blank">departmental calendar</a> normally in your Web browser.<br>
			In the Web address, it will say something like <font face="Courier New, Courier, mono">calendar/main.php?calendarid=<b><font color="#CC0000">mycal</font></b>&amp;view=week</font></li>
			<li>Highlight and copy the part of the Web address after the <font face="Courier New, Courier, mono">calendarid=</font> but before any ampersands (&amp;).<br>
				In the example in step 1, the calendar ID would be &quot;mycal&quot;.</li>
			<li>Paste the calendar ID into the box below.</li>
	</ol>
	<p><input name="calendarid" type="text" id="calendarid" size="40" value="<?php echo $_GET['calendarid']; ?>"> <font color="#CC0000">* Required</font></p>
</blockquote>

<p><b>Maximum Events Returned: </b></p>
<blockquote>
	<p>The maximum number of upcoming events that will be returned by this script.</p>
	<p><input name="maxevents" type="text" id="maxevents" value="<?php echo $config['MaxEvents'] ?>"> (1 - 100) <font color="#CC0000">* Required</font></p>
</blockquote>

<p><b>HTML Template:</b></p>
<blockquote>
	<select name="htmltemplate" id="htmltemplate">
		<option <?php if ($config['HTMLTemplate'] == "PARAGRAPH") echo "selected"; ?>>Paragraph</option>
		<option <?php if ($config['HTMLTemplate'] == "TABLE") echo "selected"; ?>>Table</option>
	</select>
</blockquote>

</td></tr></table></div>

<p><input type="Submit" name="createexport" value="Create the Export URL/HTML &gt;&gt;"> or keep scrolling down for more settings.</p>

<h3>Date/Time Settings:</h3>

<div style="padding-left: 20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="10" style="background-color: #EEEEEE; border-left: 4px solid #999999;"><tr><td>

<p><b>Date Format:</b></p>
	<blockquote><select name="dateformat">
		<option value="Huge" <?php if ($config['DateFormat'] == "HUGE") echo "selected"; ?>>Wednesday, October 25, 2006</option>
		<option value="Long" <?php if ($config['DateFormat'] == "LONG") echo "selected"; ?>>Wed, October 25, 2006</option>
		<option value="Normal" <?php if ($config['DateFormat'] == "NORMAL") echo "selected"; ?>>October 25, 2006</option>
		<option value="Short" <?php if ($config['DateFormat'] == "SHORT") echo "selected"; ?>>Oct. 25, 2006</option>
		<option value="Tiny" <?php if ($config['DateFormat'] == "TINY") echo "selected"; ?>>Oct 25 '06</option>
		<option value="Micro" <?php if ($config['DateFormat'] == "MICRO") echo "selected"; ?>>Oct 25</option>
	</select></blockquote>

<p><b>Time Display:</b></p>
<blockquote>
	<p>The time can only display the starting time, display the start and end time, or display the start time and how long the event will last (aka: duration).</p>
	<table border="0" cellpadding="4" cellspacing="0">
	<tr>
		<td style="border-bottom: 1px solid #999999; padding-right: 8px;"><b>Start Only:</b></td>
		<td style="border-bottom: 1px solid #999999; padding-left: 8px; border-left: 1px solid #666666;"><b>Start and End:</b></td>
		<td style="border-bottom: 1px solid #999999; padding-left: 8px; border-left: 1px solid #666666;"><b>Start and Duration:</b></td>
	</tr>
	<tr>
		<td style="padding-right: 8px;" valign="top">
			<table border="0" cellpadding="0" cellspacing="2">
				<tr><td><input type="radio" id="timedisplay_Start"  name="timedisplay" value="Start" <?php if ($config['TimeDisplay'] == "START") echo "checked"; ?>></td><td><label for="timedisplay_Start">12:00pm</label></td></tr>
			</table>
		</td>
		<td style="padding-left: 8px; border-left: 1px solid #666666;" valign="top">
			<table border="0" cellpadding="0" cellspacing="2">
				<tr><td><input type="radio" id="timedisplay_StartEndLong"  name="timedisplay" value="StartEndLong" <?php if ($config['TimeDisplay'] == "STARTENDLONG") echo "checked"; ?>></td><td><label for="timedisplay_StartEndLong">12:00pm to 12:30pm</label></td></tr>
				<tr><td><input type="radio" id="timedisplay_StartEndNormal"  name="timedisplay" value="StartEndNormal" <?php if ($config['TimeDisplay'] == "STARTENDNORMAL") echo "checked"; ?>></td><td><label for="timedisplay_StartEndNormal">12:00pm - 12:30pm</label></td></tr>
				<tr><td><input type="radio" id="timedisplay_StartEndTiny"  name="timedisplay" value="StartEndTiny" <?php if ($config['TimeDisplay'] == "STARTENDTINY") echo "checked"; ?>></td><td><label for="timedisplay_StartEndTiny">12:00pm-12:30pm</label></td></tr>
			</table>
		</td>
		<td style="padding-left: 8px; border-left: 1px solid #666666;" valign="top">
			<table border="0" cellpadding="0" cellspacing="2">
				<tr><td><input type="radio" id="timedisplay_StartDurationLong"  name="timedisplay" value="StartDurationLong" <?php if ($config['TimeDisplay'] == "STARTDURATIONLONG") echo "checked"; ?>></td><td><label for="timedisplay_StartDurationLong">12:00pm for 2 hours</label></td></tr>
				<tr><td><input type="radio" id="timedisplay_StartDurationNormal"  name="timedisplay" value="StartDurationNormal" <?php if ($config['TimeDisplay'] == "STARTDURATIONNORMAL") echo "checked"; ?>></td><td><label for="timedisplay_StartDurationNormal">12:00pm (2 hours)</label></td></tr>
				<tr><td><input type="radio" id="timedisplay_StartDurationShort"  name="timedisplay" value="StartDurationShort" <?php if ($config['TimeDisplay'] == "STARTDURATIONSHORT") echo "checked"; ?>></td><td><label for="timedisplay_StartDurationShort">12:00pm 2 hours</label></td></tr>
			</table>
		</td>
	</tr>
	</table>
	<!--
	<select name="timedisplay">
		<option value="Start" <?php if ($config['TimeDisplay'] == "START") echo "selected"; ?>>12:00pm</option>
		<option value="StartEndLong" <?php if ($config['TimeDisplay'] == "STARTENDLONG") echo "selected"; ?>>12:00pm to 12:30pm</option>
		<option value="StartEndNormal" <?php if ($config['TimeDisplay'] == "STARTENDNORMAL") echo "selected"; ?>>12:00pm - 12:30pm</option>
		<option value="StartEndTiny" <?php if ($config['TimeDisplay'] == "STARTENDTINY") echo "selected"; ?>>12:00pm-12:30pm</option>
		<option value="StartDurationLong" <?php if ($config['TimeDisplay'] == "STARTDURATIONLONG") echo "selected"; ?>>12:00pm for 2 hours</option>
		<option value="StartDurationNormal" <?php if ($config['TimeDisplay'] == "STARTDURATIONNORMAL") echo "selected"; ?>>12:00pm (2 hours)</option>
		<option value="StartDurationShort" <?php if ($config['TimeDisplay'] == "STARTDURATIONSHORT") echo "selected"; ?>>12:00pm 2 hours</option>
	</select>
	-->
</blockquote>

<p><b>Time Format:</b></p>
<blockquote>
	<p>You can change how much information is included when a time is displayed (this effects both start and end times).</p>
	<select name="timeformat">
		<option value="Huge" <?php if ($config['TimeFormat'] == "HUGE") echo "selected"; ?>>12:00 PM EST</option>
		<option value="Long" <?php if ($config['TimeFormat'] == "LONG") echo "selected"; ?>>12:00 PM</option>
		<option value="Normal" <?php if ($config['TimeFormat'] == "NORMAL") echo "selected"; ?>>12:00pm</option>
		<option value="Short" <?php if ($config['TimeFormat'] == "SHORT") echo "selected"; ?>>12:00p</option>
	</select>
	<!-- If you are using 24-hour time, then remove the select and option tags above and uncomment the section below -->
	<!--<select name="timeformat">
		<option value="Long" <?php if ($config['TimeFormat'] == "LONG") echo "selected"; ?>>24:00 EST</option>
		<option value="Normal" <?php if ($config['TimeFormat'] == "NORMAL") echo "selected"; ?>>24:00</option>
	</select>-->
</blockquote>

<p><b>Duration Format:</b></p>
<blockquote>
	<select name="durationformat">
		<option value="Long" <?php if ($config['DurationFormat'] == "LONG") echo "selected"; ?>>2 hours 30 minutes</option>
		<option value="Normal" <?php if ($config['DurationFormat'] == "NORMAL") echo "selected"; ?>>2 hours 30 min</option>
		<option value="Short" <?php if ($config['DurationFormat'] == "SHORT") echo "selected"; ?>>2 hrs 30 min</option>
		<option value="Tiny" <?php if ($config['DurationFormat'] == "TINY") echo "selected"; ?>>2hrs 30min</option>
		<option value="Micro" <?php if ($config['DurationFormat'] == "MICRO") echo "selected"; ?>>2hr 30m</option>
	</select>
</blockquote>

<p><b>Combine Repeating Events:</b></p>
<blockquote>
	<p>XXXX</p>
	<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td><input name="combinerepeating" id="combinerepeating_yes" type="radio" value="yes" <?php if ($config['CombineRepeating'] == "Y") echo "checked"; ?>></td>
				<td><label for="combinerepeating_yes">Combine Occurrences</label></td>
				</tr>
			<tr>
				<td><input name="combinerepeating" id="combinerepeating_no" type="radio" value="no" <?php if ($config['CombineRepeating'] == "N") echo "checked"; ?>></td>
				<td><label for="combinerepeating_no">List All Occurrences</label></td>
				</tr>
		</table>
</blockquote>

</td></tr></table></div>

<h3>Display Settings:</h3>

<div style="padding-left: 20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="10" style="background-color: #EEEEEE; border-left: 4px solid #999999;"><tr><td>

<p><b>Show Date/Time:</b></p>
<blockquote>
	<p>You may show or hide the date and time in the returned events.<br>
		This can be done if you have a limited amount of space on your web site.</p>
	<p><i>Note:</i> It is recommended to show the date and time. </p>
	<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td><input name="showdatetime" id="showdatetime_yes" type="radio" value="yes" <?php if ($config['ShowDateTime'] == "Y") echo "checked"; ?>></td>
				<td><label for="showdatetime_yes">Show</label></td>
				</tr>
			<tr>
				<td><input name="showdatetime" id="showdatetime_no" type="radio" value="no" <?php if ($config['ShowDateTime'] == "N") echo "checked"; ?>></td>
				<td><label for="showdatetime_no">Hide</label></td>
				</tr>
		</table>
</blockquote>

<p><b>Show Location: </b></p>
<blockquote>
	<p>You may show or hide the location in the returned events.<br>
		This can be done if you have a limited amount of space on your web site.</p>
	<table border="0" cellspacing="1" cellpadding="0">
		<tr>
			<td><input name="showlocation" id="showlocation_yes" type="radio" value="yes" <?php if ($config['ShowLocation'] == "Y") echo "checked"; ?>></td>
			<td><label for="showlocation_yes">Show</label></td>
			</tr>
		<tr>
			<td><input name="showlocation" id="showlocation_no" type="radio" value="no" <?php if ($config['ShowLocation'] == "N") echo "checked"; ?>></td>
			<td><label for="showlocation_no">Hide</label></td>
			</tr>
		</table>
</blockquote>

<p><b>Show &quot;All Day&quot;:</b></p>
<blockquote>
	<p>If an event is all day (aka: it does not have a start time) you may show or hide the &quot;All Day&quot; text. This helps to keep the event listing clean if you have a lot of events that are all day.</p>
	<p><i>Note:</i> It is recommended to show &quot;All Day&quot;. </p>
	<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td><input name="showallday" id="showallday_yes" type="radio" value="yes" <?php if ($config['ShowAllDay'] == "Y") echo "checked"; ?>></td>
				<td><label for="showallday_yes">Show</label></td>
				</tr>
			<tr>
				<td><input name="showallday" id="showallday_no" type="radio" value="no" <?php if ($config['ShowAllDay'] == "N") echo "checked"; ?>></td>
				<td><label for="showallday_no">Hide</label></td>
				</tr>
		</table>
</blockquote>

<p><b>Maximum Characters for the Title:</b></p>
<blockquote>
	<p>If you have a limited amount of space on your Web site, you may limit the length of the event title. Any  titles that are beyond this length will be truncated and an ellipse (...) will be added to the end.</p>
	<p><input name="maxtitlecharacters" type="text" id="maxtitlecharacters" value="<?php echo $_GET['maxtitlecharacters']; ?>"> (Leave blank for no maximum)</p>
</blockquote>

<p><b>Maximum Characters for the Location:</b></p>
<blockquote>
	<p>If you have a limited amount of space on your Web site, you may limit the length of the event location. Any locations that are beyond this length will be truncated and an ellipse (...) will be added to the end.</p>
	<p><input name="maxlocationcharacters" type="text" id="maxlocationcharacters" value="<?php echo $_GET['maxlocationcharacters']; ?>"> (Leave blank for no maximum)</p>
</blockquote>

</td></tr></table></div>

<h3>Filter Settings:</h3>

<div style="padding-left: 20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="10" style="background-color: #EEEEEE; border-left: 4px solid #999999;"><tr><td>

<p><b>Category Filters:</b></p>
<blockquote>
	<p>Adding category IDs below will filter the events that are returned from this script. </p>
	<p><input name="filterby" type="text" id="filterby" size="50" value="<?php echo $_GET['filterby']; ?>"><br>(Coma delimited list of category IDs; Leave blank for no filter)</p>
</blockquote>

<p><b>Hyperlink Category Filters:</b></p>
<blockquote>
	<p>Adding category IDs below will make it so when a person clicks the hyperlinks returned by this script, the calendar will automatically be showing only these categories.</p>
	<p><i>Note:</i> Typically this should be the same as the &quot;Category Filters&quot; in the previous section.</p>
	<p><input name="linkfilter" type="text" id="linkfilter" size="50" value="<?php echo $_GET['linkfilter']; ?>"><br>(Coma delimited list of category IDs; Leave blank for no filter)</p>
</blockquote>

</td></tr></table></div>

<h3>Advanced Settings:</h3>

<div style="padding-left: 20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="10" style="background-color: #EEEEEE; border-left: 4px solid #999999;"><tr><td>

<p><b>Type of Data Returned:</b></p>
<blockquote>
<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td><input name="datatype" id="datatype_HTML" type="radio" value="HTML" <?php if ($config['DataType'] == "HTML") echo "checked"; ?>></td>
				<td><label for="datatype_HTML">HTML</label></td>
				</tr>
			<tr>
				<td><input name="datatype" id="datatype_XML" type="radio" value="XML" <?php if ($config['DataType'] == "XML") echo "checked"; ?>></td>
				<td><label for="datatype_XML">XML (only for advanced users)</label></td>
				</tr>
			</table>
</blockquote>

<p><b>Use JavaScript:</b></p>
<blockquote>
	<p><i>Note:</i> This only applies if you have selected HTML as the 'Type of Data Returned'.</p>
	<table border="0" cellspacing="1" cellpadding="0">
		<tr>
			<td><input name="javascript" id="javascript_yes" type="radio" value="yes" <?php if ($config['JavaScript'] == "Y") echo "checked"; ?>></td>
			<td><label for="javascript_yes">Yes (recommended)</label></td>
			</tr>
		<tr>
			<td><input name="javascript" id="javascript_no" type="radio" value="no" <?php if ($config['JavaScript'] == "N") echo "checked"; ?>></td>
			<td><label for="javascript_no">No</label></td>
			</tr>
		</table>
</blockquote>

</td></tr></table></div>

<p><input type="Submit" name="createexport" value="Create the Export HTML/JavaScript &gt;&gt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>- or -</b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="instructions.php">Reset the Form</a></p>
</form>
<?php } ?>

<!-- End Body -->
</td>
	</tr>
	<tr>
		<td style="padding: 4px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">&copy; <a href="http://www.howard.edu/"><font color="#0000ff">Howard University</font></a>, all rights reserved.<br>
HOWARD UNIVERSITY, 2400 Sixth Street, NW, Washington, DC 20059<br>
Phone: 202-806-6100 - <a href="http://www.howard.edu/contacts/"><font color="#0000ff">Webmaster / Contacts</font></a> - <a href="http://www.howard.edu/disclaimer.asp"><font color="#0000ff">WWW Disclaimer</font></a></td>
	</tr>
</table>
</body>
</html>
