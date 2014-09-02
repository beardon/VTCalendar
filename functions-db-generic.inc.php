<?php
// Returns a DB connection to the database, or a string that represents an error message.
function DBOpen($DSN = null, $DebugInfo = false) {
	$connection = DB::connect(($DSN === null ? DATABASE : $DSN));
	
	if (DB::isError($connection)) {
		if ($DebugInfo) $GLOBALS['DebugInfo'] = $connection->getDebugInfo();
		return $connection->getMessage();
	}
	
	return $connection;
}

// Closes a DB connection to the database
function DBClose($Connection = null) {
	global $DBCONNECTION;
	
	if ($Connection === null) {
		$DBCONNECTION->disconnect();
	}
	else {
		$Connection->disconnect();
	}
}

// Runs a query against the database connection.
// Returns a record list if successful.
// Returns a string with an error message if unsuccessful.
function DBQuery($query, $Connection = null, $DebugInfo = false) {
	global $DBCONNECTION;
	
	if ($Connection === null) {
		$result = $DBCONNECTION->query($query);
	}
	else {
		$result = $Connection->query($query);
	}
	
	if (DB::isError($result)) {
		if ($DebugInfo) $GLOBALS['DebugInfo'] = $connection->getDebugInfo();
		return DB::errorMessage($result);
	}
	
	// Write to the SQL log file if one is defined.
	if (defined("SQLLOGFILE") && SQLLOGFILE != "") {
		$logfile = fopen(SQLLOGFILE, "a");
		
		// Log the username if logged in.
		if (!empty($_SESSION["AUTH_USERID"])) {
			$user = $_SESSION["AUTH_USERID"];
		}
		else {
			$user = "anonymous";
		}
		
		// Write the log entry and close the log.
		fputs($logfile, date( "Y-m-d H:i:s", time() )." ".$_SERVER["REMOTE_ADDR"]." ".$user." ".$_SERVER["PHP_SELF"]." ".$query."\n");
		fclose($logfile);	
	}
	
	return $result;
}

// escapes a value to make it safe for a SQL query
if (!function_exists('sqlescape')) {
	function sqlescape($value) {
	  if (preg_match("/^pgsql/",DATABASE)) {
		  return pg_escape_string($value);
		}
		else {
			return mysql_escape_string($value);
		}
	}
}

function DBErrorBox($message="") {
	?>
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
	<table class="ErrorTable" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td style="padding: 8px;"><img src="images/warning_48w.gif" width="48" height="48"></td>
				<td style="padding: 8px;"><h1>Database Error:</h1>
				<div>An error was encountered when attempting to access the database.<?php
					if (!empty($message)) {
						?><br><b>Error Message: <?php echo htmlentities($message); ?></b><?php
					}
					?></div></td>
		</tr>
	</table>
	<?php
}
?>