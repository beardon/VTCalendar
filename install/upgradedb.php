<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Install or Upgrade VTCalendar Database (MySQL 4.2+ or PostgreSQL 8+)</title>
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


<h1>Install or Upgrade VTCalendar Database (MySQL 4.2+ or PostgreSQL 8+)</h1>

<?php

define("NOLOADDB", true);
@(include_once('../config.inc.php')) or die('config.inc.php was not found. See: <a href="index.php">VTCalendar Installation</a>.');
require_once('../application.inc.php');
require_once("upgradedb-functions.php");
require_once("upgradedb-data.php");

$Submit_Preview = isset($_POST['Submit_Preview']) && $_POST['Submit_Preview'] != "";
$Submit_Upgrade = isset($_POST['Submit_Upgrade']) && $_POST['Submit_Upgrade'] != "";

if (isset($_POST['UpgradeSQL'])) $UpgradeSQL = $_POST['UpgradeSQL'];
if (isset($_GET['Success'])) $Success = $_GET['Success'];

if (isset($_POST['DBTYPE']) && preg_match("/^(mysql|postgres)$/", $_POST['DBTYPE'])) define("DBTYPE", $_POST['DBTYPE']);
if (isset($_GET['DBTYPE']) && preg_match("/^(mysql|postgres)$/", $_GET['DBTYPE'])) define("DBTYPE", $_GET['DBTYPE']);

if (isset($_POST['POSTGRESSCHEMA']) && $_POST['POSTGRESSCHEMA'] != '') define("POSTGRESSCHEMA", $_POST['POSTGRESSCHEMA']);
if (isset($_GET['POSTGRESSCHEMA']) && $_GET['POSTGRESSCHEMA'] != '') define("POSTGRESSCHEMA", $_GET['POSTGRESSCHEMA']);

if (isset($_POST['DSN']) && $_POST['DSN'] != '') define("DSN", $_POST['DSN']);
if (isset($_GET['DSN']) && $_GET['DSN'] != '') define("DSN", $_GET['DSN']);

// Flag if the all form fields have been submitted.
$FormIsComplete = defined("DBTYPE") && defined("DSN") && defined("POSTGRESSCHEMA");

// Set the field qualifier for SQL output
if (defined("DBTYPE") && DBTYPE == 'postgres') {
	define("FIELDQUALIFIER", '"');
}
else {
	define("FIELDQUALIFIER", '`');
}

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
elseif ($Submit_Preview && $FormIsComplete) {
	?><h2>Upgrade Preview:</h2><?php
	
	$FinalSQL = "";
	
	$DBCONNECTION =& DBOpen(DSN);
	if (is_string($DBCONNECTION)) {
		echo "<div class='Error'><b>Error:</b> Could not connect to the database: " . $DBCONNECTION . "</div>";
	}
	else {
		if (DBTYPE == 'postgres') {
			define("SCHEMA", POSTGRESSCHEMA);
		}
		else {
			$result =& DBquery("SELECT DATABASE() as SCHEMANAME");
			if (is_string($result)) {
				echo "<div class='Error'><b>Error:</b> Failed to determine schema name: " . $result . "</div>";
			}
			else {
				$record =& $result->fetchRow(DB_FETCHMODE_ASSOC, 0);
				define("SCHEMA", $record["SCHEMANAME"]);
				$result->free();
			}
		}
		
		// Get the DB version
		$result =& DBQuery("SELECT version() as ver");
		if (is_string($result)) {
			echo "<div class='Error'><b>Error:</b> Failed to determine database version: " . $result . "</div>";
		}
		else {
			$record =& $result->fetchRow(DB_FETCHMODE_ASSOC, 0);
			
			if (DBTYPE == 'mysql') {
				$matchResult = preg_match("/^([\d]+\.[\d]+)/", $record["ver"], $matches);
				define("DBVERSIONOK", $matchResult && !empty($matches[1]) && intval($matches[1]) >= 4.2);
			}
			elseif (DBTYPE == 'postgres') {
				define("DBVERSIONOK", preg_match("/^PostgreSQL 8\./i", $record["ver"]));
			}
			$result->free();
		}
		
		if (defined("SCHEMA") && defined("DBVERSIONOK")) {
			
			// Get the current table data.
			if (($CurrentTables = GetTables()) !== false) {
				
				?><p>The following is a preview of changes to the database that are needed.<br/>To apply any needed changes, proceed to the <a href="#Upgrade">Upgrade the Database</a> section at the bottom of this page.</p><?php
				
//				echo "<pre>"; var_dump($FinalTables); var_dump($CurrentTables); echo "</pre>"; exit;
				
				// Check the current table data vs the final table data.
				$changes = CheckTables();
				
				?><h3>Records</h3><blockquote><?php
				
				$InsertDefaultRecord_Calendar = false;
				$InsertDefaultRecord_Category = false;
				$InsertDefaultRecord_Sponsor = false;
				
				// Check if the default calendar records exist
				if (!array_key_exists('vtcal_calendar', $CurrentTables)) {
					echo "<div class='Create Record'><b>Insert Record:</b> The <b>default calendar</b> is missing and will be created.</div>";
					$InsertDefaultRecord_Calendar = true;
				}
				else {
					$result =& DBQuery("SELECT id FROM " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_calendar" . FIELDQUALIFIER . " WHERE id='default'");
					if (is_string($result)) {
						echo "<div class='Error'><b>Error:</b> Could not SELECT from " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_calendar" . FIELDQUALIFIER . " to determine if default calendar exists: " . $result . "</div>";
						$changes += 0.0001;
					}
					else {
						if ($result->numRows() == 0) {
							echo "<div class='Create Record'><b>Insert Record:</b> The <b>default calendar</b> is missing and will be created.</div>";
							$InsertDefaultRecord_Calendar = true;
						}
						else {
							echo "<div class='Success'><b>OK:</b> Default calendar exists.</div>";
						}
						$result->free();
					}
				}
				
				if ($InsertDefaultRecord_Calendar) {
					$FinalSQL .= "INSERT INTO " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_calendar" . FIELDQUALIFIER . " "
						. "(id, name, title, header, footer, viewauthrequired, forwardeventdefault) "
						. "VALUES ('default', 'Default Calendar', 'Events Calendar', '', '', 0, 0);\n\n";
					$changes++;
				}
				
				// Check if the default calendar has categories
				if (!array_key_exists('vtcal_category', $CurrentTables)) {
					echo "<div class='Create Record'><b>Insert Record:</b> The default calendar is missing <b>categories</b>, so one will be created.</div>";
					$InsertDefaultRecord_Category = true;
				}
				else {
					$result =& DBQuery("SELECT id FROM " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_category" . FIELDQUALIFIER . " WHERE calendarid='default'");
					if (is_string($result)) {
						echo "<div class='Error'><b>Error:</b> Could not SELECT from " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_category" . FIELDQUALIFIER . " to determine if categories exist for the default: " . $result . "</div>";
						$changes += 0.0001;
					}
					else {
						if ($result->numRows() == 0) {
							echo "<div class='Create Record'><b>Insert Record:</b> The default calendar is missing <b>categories</b>, so one will be created.</div>";
							$InsertDefaultRecord_Category = true;
						}
						else {
							echo "<div class='Success'><b>OK:</b> At least one category exists for the default calendar.</div>";
						}
						$result->free();
					}
				}
				
				if ($InsertDefaultRecord_Category) {
					$FinalSQL .= "INSERT INTO " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_category" . FIELDQUALIFIER . " (calendarid, name) VALUES ('default', '".sqlescape(lang('default_category_name'))."');\n\n";
					$changes++;
				}
				
				// Check if the default calendar has an admin sponsor.
				if (!array_key_exists('vtcal_sponsor', $CurrentTables)) {
					echo "<div class='Create Record'><b>Insert Record:</b> The default calendar is missing the <b>admin sponsor</b>, so it will be created.</div>";
					$InsertDefaultRecord_Sponsor = true;
				}
				else {
					$result =& DBQuery("SELECT id FROM " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_sponsor" . FIELDQUALIFIER . " WHERE calendarid='default' AND admin='1'");
					if (is_string($result)) {
						echo "<div class='Error'><b>Error:</b> Could not SELECT from " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_sponsor" . FIELDQUALIFIER . " to determine if the admin sponsor exists for the default calendar: " . $result . "</div>";
						$changes += 0.0001;
					}
					else {
						if ($result->numRows() == 0) {
							echo "<div class='Create Record'><b>Insert Record:</b> The default calendar is missing the <b>admin sponsor</b>, so it will be created.</div>";
							$InsertDefaultRecord_Sponsor = true;
						}
						else {
							echo "<div class='Success'><b>OK:</b> The admin sponsor exists for the default calendar.</div>";
						}
						$result->free();
					}
				}
				
				if ($InsertDefaultRecord_Sponsor) {
					$FinalSQL .= "INSERT INTO " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_sponsor" . FIELDQUALIFIER . " (calendarid, name, url, email, admin) VALUES ('default', '".sqlescape(lang('default_sponsor_name'))."', '', '', 1);\n\n";
					$changes++;
				}
				
				// Check if the URL column exists in the vtcal_event table.
				if (array_key_exists('vtcal_event', $CurrentTables) && array_key_exists('url', $CurrentTables['vtcal_event']['Fields'])) {
				
					// Check if the URL field contains any data.
					$result =& DBQuery("SELECT count(*) as reccount FROM " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_event" . FIELDQUALIFIER . " WHERE url != ''");
					if (is_string($result)) {
						echo "<div class='Error'><b>Error:</b> Could not SELECT from " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_event" . FIELDQUALIFIER . " to determine data exists in the <code>url</code> column: " . $result . "</div>";
						$changes += 0.0001;
					}
					else {
						// Concat the description and URL column if the URL columns contains data.
						$record =& $result->fetchRow(DB_FETCHMODE_ASSOC, 0);
						if ($record['reccount'] > 0) {
							echo "<div class='Alter Record'><b>Update Records:</b> Data exists in the <code>url</code> column in the <code>vtcal_event</code>/<code>vtcal_event_public</code> tables. The <code>url</code> column will be appended to the end of the description column, and then it will be set to an empty string.</div>";
							if (DBTYPE == 'mysql') {
								$FinalSQL .= "UPDATE " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_event" . FIELDQUALIFIER . " SET description = concat(description, '\\n\\n', '" . sqlescape(lang('more_information')) . ": ', url), url = '' WHERE URL != '';\n\n";
								$FinalSQL .= "UPDATE " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_event_public" . FIELDQUALIFIER . " SET description = concat(description, '\\n\\n', '" . sqlescape(lang('more_information')) . ": ', url), url = '' WHERE URL != '';\n\n";
							}
							elseif (DBTYPE == 'postgres') {
								$FinalSQL .= "UPDATE " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_event" . FIELDQUALIFIER . " SET description = description || E'\\n\\n' || '" . sqlescape(lang('more_information')) . ": ' || url, url = '' WHERE URL != '';\n\n";
								$FinalSQL .= "UPDATE " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . "vtcal_event_public" . FIELDQUALIFIER . " SET description = description || E'\\n\\n' || '" . sqlescape(lang('more_information')) . ": ' || url, url = '' WHERE URL != '';\n\n";
							}
							$changes++;
						}
						$result->free();
					}
				}

				
				?></blockquote><?php
		
				?><h2><a name="Upgrade"></a>Upgrade Database:</h2>
				<form action="upgradedb.php" method="post" onsubmit="return verifyUpgrade();">
				<input type="hidden" name="DBTYPE" value="<?php echo DBTYPE; ?>"/>
				<input type="hidden" name="DSN" value="<?php echo DSN; ?>"/>
				<input type="hidden" name="POSTGRESSCHEMA" value="<?php echo POSTGRESSCHEMA; ?>"/>
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
elseif ($Submit_Upgrade && $FormIsComplete && isset($UpgradeSQL)) {
	?><h2>Upgrade Result:</h2><?php
	
	$DBCONNECTION =& DBOpen(DSN);
	if (is_string($DBCONNECTION)) {
		echo "<div class='Error'><b>Error:</b> Could not connect to the database: " . $DBCONNECTION . "</div>";
	}
	else {
		$queries = preg_split("/((\r\n\r\n)|(\n\n))/", $UpgradeSQL);
		$queryError = false;
		
		for ($i = 0; $i < count($queries); $i++) {
			if (!trim($queries[$i]) == "") {
				$result =& DBquery($queries[$i], NULL, $DebugInfo);
				if (is_string($result)) {
					$queryError = true;
					echo "<div class='Error'><b>Error:</b> Query # " . ($i+1) . " failed: " . $result;
					?>
					<table width="100%" border="0" cellpadding="3" cellspacing="0">
					<tr>
						<td width="50%"><div style="font-weight: bold; padding-bottom: 2px; padding-left: 4px;">Query:</div><textarea style="width: 100%" cols="60" rows="5" readonly="readonly" onfocus="this.select();" onclick="this.select(); this.focus();"><?php echo htmlentities($queries[$i]); ?></textarea></td>
						<td width="50%"><div style="font-weight: bold; padding-bottom: 2px; padding-left: 4px;">Error Details:</div><textarea style="width: 100%" cols="60" rows="5" readonly="readonly" onfocus="this.select();" onclick="this.select(); this.focus();"><?php echo htmlentities(str_replace($queries[$i], "", $DebugInfo)); ?></textarea></td>
					</tr>
					</table>
					</div>
					<?php
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
	<script type="text/javascript"><!-- // <![CDATA[
	function ToggleBlocks() {
		if (document.getElementById) {
			var objDBTYPE = document.getElementById('DBTYPE');
			var objPOSTGRESSCHEMA_Block = document.getElementById('POSTGRESSCHEMA_Block');
			var objMySQLExample = document.getElementById('mysql_example');
			var objPostgresExample = document.getElementById('postgres_example');
			
			if (objDBTYPE) {
				if (objPOSTGRESSCHEMA_Block) {
					objPOSTGRESSCHEMA_Block.style.display = (objDBTYPE.value == 'postgres' ? '' : 'none');
				}
				
				if (objMySQLExample && objPostgresExample) {
					if (objDBTYPE.value == 'mysql') {
						objMySQLExample.style.display = '';
						objPostgresExample.style.display = 'none';
					}
					else {
						objMySQLExample.style.display = 'none';
						objPostgresExample.style.display = '';
					}
				}
			}
		}
	}
	// ]]> -->
	</script>
	<form action="upgradedb.php" method="POST">
		<p><b>Select Database Type:</b><br />
			<select name="DBTYPE" id="DBTYPE" onchange="ToggleBlocks()" onclick="ToggleBlocks()">
				<option value="" <?php if (!defined("DBTYPE")) echo "SELECTED"; ?>>(Select One)</option>
				<option value="mysql" <?php if (defined("DBTYPE") && DBTYPE == 'mysql') echo "SELECTED"; ?>>MySQL</option>
				<option value="postgres" <?php if (defined("DBTYPE") && DBTYPE == 'postgres') echo "SELECTED"; ?>>PostgreSQL</option>
			</select>
		</p>
		
		<p><b>Database Connection String:</b><br /> 
	    	<input name="DSN" type="text" id="DSN" size="60" value="<?php if (defined("DSN")) echo DSN; ?>" style="width: 600px;" /><br/>
	    	<i id="mysql_example">Syntax: mysql://user:password@host/database</i>
	    	<i id="postgres_example">Syntax: pgsql://user:password@host/database</i></p>
		
		<p id="POSTGRESSCHEMA_Block"><b>Schema (PostgreSQL Only):</b><br /> 
	    	<input name="POSTGRESSCHEMA" type="text" id="POSTGRESSCHEMA" size="60" value="<?php echo (defined("POSTGRESSCHEMA") ? POSTGRESSCHEMA : 'public'); ?>" style="width: 200px;" /><br/>
	    	<i>Example: public</p>
	    
		<p><input type="submit" name="Submit_Preview" value="Preview Database Upgrades" /></p>
	</form>
	
	<script type="text/javascript"><!-- // <![CDATA[
	ToggleBlocks();
	// ]]> -->
	</script>
	</blockquote>
	<?php
}

?>

</body>
</html>