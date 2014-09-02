<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Install or Upgrade VTCalendar Database (MySQL Only)</title>
<link href="styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
function verifyUpgrade() {
	return confirm("Are you sure you want to upgrade the database?");
}
</script>
</head>

<body id="UpgradeDB">


<?php
@(include_once('../version.inc.php')) or die('version.inc.php was not found or could not be read. Make sure it exists in the VTCalendar folder and it defines a constant named "VERSION".');
if (!defined("VERSION")) die('VERSION was not defined. Make sure version.inc.php defines a constant named "VERSION" (e.g. <code>define("VERSION", "2.3.0");</code>).');

if (file_exists("../VERSION-DBCHECKED.txt")) {
	if (($dbVersionChecked = file_get_contents("../VERSION-DBCHECKED.txt")) === false) die("VERSION-DBCHECKED.txt exists but could not be. May not have read access to the file.");
	if (trim(VERSION) == trim($dbVersionChecked)) {
		echo "<h1 style='color: red;'>Database Already Installed or Upgraded:</h1>"
			."<p>The database has already been checked for version " . VERSION . ".</p>"
			."<p>If you would like to run this script, remove the <code>VERSION-DBCHECKED.txt</code> file in the VTCalendar folder.</p></body></html>";
		exit;
	}
}
?>


<h1>Install or Upgrade VTCalendar Database (MySQL Only)</h1>

<?php

@(include_once('DB.php')) or die('Pear::DB does not seem to be installed. See: http://pear.php.net/package/DB');
require_once("../functions-io.inc.php");
require_once("../functions-db-generic.inc.php");
require_once("upgradedb-functions.php");
require_once("upgradedb-data.php");

$Submit_Preview = isset($_POST['Submit_Preview']) && $_POST['Submit_Preview'] != "";
$Submit_Upgrade = isset($_POST['Submit_Upgrade']) && $_POST['Submit_Upgrade'] != "";

if (isset($_POST['UpgradeSQL'])) $UpgradeSQL = $_POST['UpgradeSQL'];
if (isset($_GET['Success'])) $Success = $_GET['Success'];
if (isset($_GET['DSN'])) define("DATABASE", $_GET['DSN']);
if (isset($_POST['DSN'])) define("DATABASE", $_POST['DSN']);

// Display the success screen if successful.
if (isset($Success)) {
	?><h2>Upgrade Result:</h2><?php
	
	if ($Success == "nochanges") {
		?><div class="Success">No changes to the database were necessary.</div><?php
	}
	else {
		?><div class="Success"><b>Success:</b> All upgrades were applied successfully!</div><?php
	}
	
	?><p>&lt;&lt; <a href="index.php">Return to the VTCalendar Installation page.</a></p><?php
	
	$versionRecorded = (file_put_contents("../VERSION-DBCHECKED.txt", VERSION) !== false);
	
	if (!$versionRecorded) {
		?><div class="Error"><b>Warning:</b> The <code>VERSION-DBCHECKED.txt</code> file could not be created/changed. To avoid people from accessing this page (and potentially compromising your database), create a file named <code>VERSION-DBCHECKED.txt</code> in the VTCalendar folder that contains the text &quot;<?php echo VERSION; ?>&quot; (without the quotes). On Linux the file name is case-sensitive.</div><?php
	}
}

// Display the preview screen if the DSN was submitted.
elseif ($Submit_Preview && defined("DATABASE")) {
	?><h2>Upgrade Preview:</h2><?php
	
	$FinalSQL = "";
	
	$DBCONNECTION =& DBOpen();
	if (is_string($DBCONNECTION)) {
		echo "<div class='Error'><b>Error:</b> Could not connect to the database: " . $DBCONNECTION . "</div>";
	}
	else {
	
		$result =& DBquery("SELECT DATABASE() as SCHEMANAME");
		if (is_string($result)) {
			echo "<div class='Error'><b>Error:</b> Failed to determine schema name: " . $result . "</div>";
		}
		else {
			$record =& $result->fetchRow(DB_FETCHMODE_ASSOC, 0);
			define("SCHEMA", $record['SCHEMANAME']);
			$result->free();
			
			// Get the current table data.
			if (($CurrentTables = GetTables()) !== false) {
				
				?><p>The following is a preview of changes to the database that are needed.<br/>To apply any needed changes, proceed to the <a href="#Upgrade">Upgrade the Database</a> section at the bottom of this page.</p><?php
				
				// Check the current table data vs the final table data.
				$changes = CheckTables();
				
				?><h3>Records</h3><blockquote><?php
				
				// Check if the default calendar records exist
				$result =& DBQuery("SELECT id FROM vtcal_calendar WHERE id='default'");
				if (is_string($result)) {
					echo "<div class='Error'><b>Error:</b> Could not SELECT from vtcal_calendar to determine if default calendar exists: " . $result . "</div>";
				}
				else {
					if ($result->numRows() == 0) {
						echo "<div class='Create Record'><b>Insert Record:</b> The <b>default calendar</b> is missing and will be created.</div>";
						$FinalSQL .= "INSERT INTO vtcal_calendar "
							. "(id, name, title, header, footer, viewauthrequired, forwardeventdefault) "
							. "VALUES ('default', 'Default Calendar', 'Events Calendar', '', '', 0, 0);\n\n";
						$changes++;
					}
					else {
						echo "<div class='Success'><b>OK:</b> Default calendar exists.</div>";
					}
					$result->free();
				}
				
				// Check if the default calendar has categories
				$result =& DBQuery("SELECT id FROM vtcal_category WHERE calendarid='default'");
				if (is_string($result)) {
					echo "<div class='Error'><b>Error:</b> Could not SELECT from vtcal_category to determine if categories exist for the default: " . $result . "</div>";
				}
				else {
					if ($result->numRows() == 0) {
						echo "<div class='Create Record'><b>Insert Record:</b> The default calendar is missing <b>categories</b>, so one will be created.</div>";
						$FinalSQL .= "INSERT INTO vtcal_category (calendarid, name) VALUES ('default', 'General');\n\n";
						$changes++;
					}
					else {
						echo "<div class='Success'><b>OK:</b> At least one category exists for the default calendar.</div>";
					}
					$result->free();
				}
				
				// Check if the default calendar has an admin sponsor.
				$result =& DBQuery("SELECT id FROM vtcal_sponsor WHERE calendarid='default' AND admin='1'");
				if (is_string($result)) {
					echo "<div class='Error'><b>Error:</b> Could not SELECT from vtcal_sponsor to determine if the admin sponsor exists for the default calendar: " . $result . "</div>";
				}
				else {
					if ($result->numRows() == 0) {
						echo "<div class='Create Record'><b>Insert Record:</b> The default calendar is missing the <b>admin sponsor</b>, so it will be created.</div>";
						$FinalSQL .= "INSERT INTO vtcal_sponsor (calendarid, name, url, email, admin) VALUES ('default', 'Administration', '', '', 1);\n\n";
						$changes++;
					}
					else {
						echo "<div class='Success'><b>OK:</b> The admin sponsor exists for the default calendar.</div>";
					}
					$result->free();
				}
				
				?></blockquote><?php
		
				?><h2><a name="Upgrade"></a>Upgrade Database:</h2>
				<form action="upgradedb.php" method="post" onsubmit="return verifyUpgrade();">
				<input type="hidden" name="DSN" value="<?php echo DATABASE; ?>"/>
				<blockquote><?php
				
				if ($changes < 1) {
					?><div class="Success">No changes to the database were necessary.</div><?php
					
					// Show a cleaner success page if no changes or notifications were outputted.
					if ($changes == 0) {
						echo '<script type="text/javascript">location.replace("upgradedb.php?Success=nochanges")</script>';
					}
					else {
						$versionRecorded = (file_put_contents("../VERSION-DBCHECKED.txt", VERSION) !== false);
						
						if (!$versionRecorded) {
							?><div class="Error"><b>Warning:</b> The <code>VERSION-DBCHECKED.txt</code> file could not be created/changed. To avoid people from accessing this page (and potentially compromising your database), create a file named <code>VERSION-DBCHECKED.txt</code> in the VTCalendar folder that contains the text &quot;<?php echo VERSION; ?>&quot; (without the quotes). On Linux the file name is case-sensitive.</div><?php
						}
					}
				}
				else {
					?>
					<p style="font-size: 18px; padding: 8px; background-color: #FFEEEE; border: 1px solid #FF3333;"><b>LAST WARNING!</b><br/>If you are upgrading VTCalendar, it is recommended that you backup your entire VTCalendar database. Changes made by applying this upgrade CANNOT be undone without a backup.</p>
					<p>After reviewing the above upgrades you may <input type="submit" name="Submit_Upgrade" value="Upgrade the Database"/></p>
					<p style="font-size: 16px; font-weight: bold;">- or -</p>
					<div>If your account does not have permission to CREATE or ALTER tables,<br/>copy/paste the SQL code below to manually upgrade your database</div>
					<textarea name="UpgradeSQL" cols="60" rows="15" readonly="readonly" onfocus="this.select();" onclick="this.select(); this.focus();"><?php echo htmlentities($FinalSQL); ?></textarea>
					<?php
				}
				
				?></blockquote></form><?php
			}
			
			DBClose();
		}
	}
}

// Upgrade the database if the DSN and SQL were submitted.
elseif ($Submit_Upgrade && defined("DATABASE") && isset($UpgradeSQL)) {
	?><h2>Upgrade Result:</h2><?php
	
	$DBCONNECTION =& DBOpen();
	if (is_string($DBCONNECTION)) {
		echo "<div class='Error'><b>Error:</b> Could not connect to the database: " . $DBCONNECTION . "</div>";
	}
	else {
		$queries = preg_split("/(\r\n\r\n)|(\n\n)/", $UpgradeSQL);
		$queryError = false;
		
		for ($i = 0; $i < count($queries); $i++) {
			if (!trim($queries[$i]) == "") {
				$result =& DBquery($queries[$i]);
				if (is_string($result)) {
					$queryError = true;
					echo "<div class='Error'><b>Error:</b> Query # " . ($i+1) . " failed: " . $result . "</div>";
					?><textarea name="UpgradeSQL" cols="60" rows="5" readonly="readonly" onfocus="this.select();" onclick="this.select(); this.focus();"><?php echo htmlentities($queries[$i]); ?></textarea><?php
				}
				else {
					echo "<div class='Success'><b>Success:</b> Query # " . ($i+1) . " successful.</div>";
				}
			}
		}
		DBClose();
					
		if (!$queryError) {
			echo '<script type="text/javascript">location.replace("upgradedb.php?Success=true")</script>';
		}
	}
}

// Otherwise display the intro form.
else {
	?>
	<h2>About this Page:</h2>
	<blockquote>
	<p>If this is a <b>fresh VTCalendar install</b> this script will create the necessary VTCalendar tables.</p>
	<p>If you are <b>upgrading VTCalendar</b> it is necessary to upgrade the database as well. This page will scan your current database schema and tell you what needs to be changed. You can then apply the changes to the database directly through this page, or copy/paste the necessary SQL into another program of your choice.</p>
	<p><b style="color: #CC0000;">Backup Your Database!</b><br/>If you are upgrading VTCalendar it is recommended that you backup your entire VTCalendar database. Changes made by applying this upgrade CANNOT be undone without a backup.</p>
	</blockquote>
	
	<h2>Enter the Database Connection String:</h2>
	<blockquote>
	<form action="upgradedb.php" method="POST">
		<p><b>Database Connection String:</b><br /> 
	    	<input name="DSN" type="text" id="DSN" size="60" value="<?php if (defined("DATABASE")) echo DATABASE; ?>" style="width: 600px;" /><br/>
	    	<i>Example: mysql://user:password@localhost/vtcalendar</i></p>
		<p><input type="submit" name="Submit_Preview" value="Preview Database Upgrades" /></p>
	</form>
	</blockquote>
	<?php
}

?>

</body>
</html>