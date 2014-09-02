<?php
define('JSSTART', '<script type="text/javascript"><!-- //<![CDATA[');
define('JSEND', '// ]]> --></script>');

@(include_once('config.inc.php'));
require_once('config-defaults.inc.php');

$Width = '';
if (isset($_GET['width']) && preg_match("/^[0-9]+(%)?$/", $_GET['width'])) {
	$Width = 'width="' . $_GET['width'] . '"';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Check VTCalendar Version</title>
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW"/>
<script type="text/javascript" src="scripts/browsersniffer.js"></script>
<script type="text/javascript" src="scripts/basicfunctions.js"></script>
<script type="text/javascript"><!-- //<![CDATA[
resultHTML = "";
function VersionResult(image, messageHTML) {
	var tableHTML = '<table border="0" cellpadding="0" cellspacing="0" border="0">';
	
	if (isArray(messageHTML)) {
		for (i = 0; i < messageHTML.length; i++) {
			tableHTML = tableHTML + '<tr><td valign="top" style="padding-top: 4px; padding-right: 8px;"><img src="' + image[i] + '" class="png" width="32" height="32" alt=""/></td><td <?php echo $Width; ?>>' + messageHTML[i] + '</td></tr>';
		}
	}
	else {
		tableHTML = tableHTML + '<tr><td valign="top" style="padding-top: 4px; padding-right: 8px;"><img src="' + image + '" class="png" width="32" height="32" alt=""/></td><td <?php echo $Width; ?>>' + messageHTML + '</td></tr>';
	}
	
	tableHTML = tableHTML + '</table>';
	if (<?php if (isset($_GET['nocallback'])) echo 'false && '; ?>parent && parent.CheckVersionHandler) {
		parent.CheckVersionHandler(image, messageHTML, tableHTML);
	}
	else {
		resultHTML = tableHTML;
	}
}
// ]]> --></script>

<?php
@(include_once('version.inc.php'));
if (!defined("VERSION")) {
	?><script type="text/javascript"><!-- //<![CDATA[
	VersionResult('install/failed32.png', 'VERSION was not defined. Make sure version.inc.php defines a constant named "VERSION" (e.g. <code>define("VERSION", 2.3.0);</code>).');
	// ]]> --></script><?php
}
elseif (!CHECKVERSION) {
	?><script type="text/javascript"><!-- //<![CDATA[
	VersionResult('install/failed32.png', '<div id="ReleaseMessage"><b>Version checking is disabled.</b><div id="ReleaseNote">Visit the <a href="http://vtcalendar.sourceforge.net/jump.php?name=release" target="_blank">download</a> page to manually check for a new version.</div></div>');
	// ]]> --></script><?php
}
else {
	if (ini_get('allow_url_fopen') && ($versionData = file_get_contents('http://vtcalendar.sourceforge.net/version.php?type=data')) !== false) {
		$jsoutput = '<script type="text/javascript">' . "<!-- //<![CDATA[\n" . 'if (document) {';
		$splitPairs = explode(';', $versionData);
		foreach ($splitPairs as $pair) {
			$splitPair = explode(':', $pair);
			$jsoutput .= ' document.' . $splitPair[0] . ' = "' . $splitPair[1] . '";';
		}
		$jsoutput .= " }\n// ]]> --></script>";
		echo $jsoutput;
	}
	else {
		// TODO: Change so this uses a Flash app to get the data.
		?><script type="text/javascript" src="http://vtcalendar.sourceforge.net/version.php?type=js"></script><?php
	}
	
	?>
	<script type="text/javascript" src="scripts/checkversion.js"></script>
	<script type="text/javascript"><!-- //<![CDATA[
	
	var Images = new Array();
	var Messages = new Array();
	
	var InstalledVTCalendarVersion = "<?php echo VERSION; ?>";
	var Result = CheckVTCalendarVersion(InstalledVTCalendarVersion, document.LatestVTCalendarVersion);
	
	if (Result == "EQUAL") {
		Images[0] = 'install/success32.png';
		Messages[0] = '<div id="ReleaseMessage">Your version of VTCalendar (' + InstalledVTCalendarVersion + ') is <b>up-to-date</b>.</div>';
	}
	else if (Result == "OLDER") {
		Images[0] = 'install/down32.png';
		Messages[0] = '<div id="ReleaseMessage">Your version of VTCalendar is ' + InstalledVTCalendarVersion + ' but a <b>newer version (' + document.LatestVTCalendarVersion + ') is available</b>.<div id="ReleaseNote">Visit the <a href="http://vtcalendar.sourceforge.net/jump.php?name=release" target="_blank">download</a> page to upgrade.</div></div>';
	}
	else if (Result == "NEWER") {
		Images[0] = 'install/warning32.png';
		Messages[0] = '<div id="ReleaseMessage">Your version of VTCalendar (' + InstalledVTCalendarVersion + ') is <b>newer than the latest release version (' + document.LatestVTCalendarVersion + ')</b>.<div id="ReleaseNote">You may be running an alpha or beta build, which are not recommended for production.</div></div>';
		
		var PreReleaseResult = CheckVTCalendarVersion(InstalledVTCalendarVersion, document.LatestVTCalendarPreReleaseVersion);
		if (PreReleaseResult == "OLDER") {
			Images[1] = 'install/down32.png';
			Messages[1] = '<div id="PreReleaseMessage">However, a <b>newer version of pre-release (' + document.LatestVTCalendarPreReleaseVersion + ')</b> is available. Visit the <a href="http://vtcalendar.sourceforge.net/jump.php?name=prerelease" target="_blank">pre-release documentation</a> to upgrade.</div>';
		}
		else if (PreReleaseResult == "EQUAL") {
			Images[1] = 'install/success32.png';
			Messages[1] = '<div id="PreReleaseMessage">However, your <b>pre-release version is up-to-date</b>.</div>';
		}
		else if (Result == "NEWER") {
			Images[1] = 'install/warning32.png';
			Messages[1] = '<div id="PreReleaseMessage">Your pre-release version is also <b>newer than the latest pre-release version (' + document.LatestVTCalendarPreReleaseVersion + ')</b>.<div id="PreReleaseNote">You may be running a trunk build, which are not recommended as it is likely broken.</div></div>';
		}
		else if (Result == "ERROR") {
			Images[1] = 'install/failed32.png';
			Messages[1] = '<div id="PreReleaseMessage">An <b>error occurred while attempting to check for a newer pre-release version</b> of VTCalendar.<div id="PreReleaseNote">Visit the <a href="http://vtcalendar.sourceforge.net/jump.php?name=prerelease" target="_blank">pre-release documentation</a> to manually check for a new version.</div></div>';
		}
	}
	else {
		Images[0] = 'install/failed32.png';
		Messages[0] = '<div id="ReleaseMessage">An <b>error occurred while attempting to check for a newer version</b> of VTCalendar.<div id="ReleaseNote">Visit <a href="http://vtcalendar.sourceforge.net/" target="_blank">http://vtcalendar.sourceforge.net/</a> to manually check for a new version.</div></div>';
	}
	
	VersionResult(Images, Messages);
	// ]]> --></script>
	<?php
}
?>
</head><body><script type="text/javascript"><!-- //<![CDATA[
document.write(resultHTML);
// ]]> --></script></body>
</html>
