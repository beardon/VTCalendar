<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Create Main Admin Accounts</title>
<link href="styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="scripts.js"></script>
<!--[if lt IE 7]><style type="text/css">.png { behavior: url(../scripts/iepngfix.htc); }</style><![endif]-->
</head>

<body>

<h1>Create Main Admin Accounts</h1>

<?php

@(include_once('DB.php')) or die('<b>Pear::DB</b> does not seem to be installed. See: http://pear.php.net/package/DB</body></html>');
@(include_once('../config.inc.php')) or die('<code>config.inc.php</code> was not found. You must first complete step 1 and 2 of the <a href="index.php">VTCalendar Installation</a></body></html>.');
require_once("../config-defaults.inc.php");
require_once("../functions-db-generic.inc.php");
require_once("../functions-db-sets.inc.php");
require_once("../functions-misc.inc.php");

$FormErrors = array();
$AccountList = array();

$Submit_Create = isset($_POST['Submit_Create']) && $_POST['Submit_Create'] != "";

if (isset($_POST['CREATEADMIN_USERNAME'])) setVar($Form_CREATEADMIN_USERNAME,$_POST['CREATEADMIN_USERNAME']); else $Form_CREATEADMIN_USERNAME = "";
if (isset($_POST['CREATEADMIN_PASSWORD'])) setVar($Form_CREATEADMIN_PASSWORD,$_POST['CREATEADMIN_PASSWORD']); else $Form_CREATEADMIN_PASSWORD = "";
if (isset($_POST['MAINADMINS'])) setVar($Form_MAINADMINS,$_POST['MAINADMINS']); else $Form_MAINADMINS = "";

if (DATABASE == "") {
	$FormErrors[count($FormErrors)] = "DATABASE has not been set. You must first complete step 1 and 2 of the <a href='index.php'>VTCalendar Installation</a>.";
}
elseif (defined("DATABASE") && DATABASE != "") {
	
	// Open a database connection
	$DBCONNECTION =& DBOpen(DATABASE);
	if (is_string($DBCONNECTION)) {
		$FormErrors[count($FormErrors)] = "Could not connect to the database: <code>" . htmlentities($DBCONNECTION) . "</code>";
	}
	else {
	
		// Get the number of admin users.
		$result =& DBQuery("SELECT count(*) as usercount FROM ".SCHEMANAME."vtcal_adminuser");
		
		// Output an error message if the query failed.
		if (is_string($result)) {
			$FormErrors[count($FormErrors)] = "Could not SELECT from ".SCHEMANAME."vtcal_adminuser. You must first complete step 1 and 2 of the <a href='index.php'>VTCalendar Installation</a>.<br/>Error: <code>" . htmlentities($result) . "</code>";
			
			// Close the DB and assign a string to $DBCONNECTION so we get the error form.
			DBClose();
			$DBCONNECTION = "";
		}
		
		// Otherwise make sure no admin users already exist.
		else {
			$record =& $result->fetchRow(DB_FETCHMODE_ASSOC, 0);
			if ($record['usercount'] > 0) {
				$FormErrors[count($FormErrors)] = "One or more main admins already exist in the database.<br/>If you forget the password for the main admin, you will need to manually remove all records from the <code>vtcal_adminuser</code> table and use this wizard again.";
				
				// Close the DB and assign a string to $DBCONNECTION so we get the error form.
				DBClose();
				$DBCONNECTION = "";
			}
		}
	}
	
	// Validate submitted data.
	if ($Submit_Create) {
		
		if (AUTH_DB) {
			if (!AUTH_LDAP && !AUTH_HTTP && trim($Form_CREATEADMIN_USERNAME) == "") {
				$FormErrors[count($FormErrors)] = "You must enter the <b>Main Admin Username</b>.";
			}
			
			// If a username was submitted...
			if (trim($Form_CREATEADMIN_USERNAME) != "") {
			
				// Fail if it does not match the RegEx.
				if (preg_match(REGEXVALIDUSERID, $Form_CREATEADMIN_USERNAME) == 0) {
					$FormErrors[count($FormErrors)] = "The username '<code>" . $Form_CREATEADMIN_USERNAME . "</code>' must match the User ID Regular Expression.";
				}
				
				// Otherwise, add it to the list of accounts to grant main admin access.
				else {
					$AccountList[count($AccountList)] = $Form_CREATEADMIN_USERNAME;
				}
				
				// Make sure the password was also submitted.
				if (trim($Form_CREATEADMIN_PASSWORD) == "") {
					$FormErrors[count($FormErrors)] = "You must enter the <b>Main Admin Password</b> along with the Main Admin Username.";
				}
			}
		}
		
		if (AUTH_LDAP || AUTH_HTTP) {
			if (!AUTH_DB && trim($Form_MAINADMINS) == "") {
				$FormErrors[count($FormErrors)] = "You must enter the <b>Accounts to Add as Main Admins</b>.";
			}
		}
		
		if (AUTH_DB && (AUTH_LDAP || AUTH_HTTP)) {
			if (trim($Form_CREATEADMIN_USERNAME) == "" && trim($Form_MAINADMINS) == "") {
				$FormErrors[count($FormErrors)] = "You must enter the <b>Main Admin Username/Password</b> and/or the <b>Accounts to Add as Main Admins</b>.";
			}
		}
		
		// Process the list of accounts to give main admin access to.
		ProcessMainAdminAccountList($Form_MAINADMINS, $AccountList);
	}
}

if (isset($DBCONNECTION) && !is_string($DBCONNECTION)) {
	
	// Attempt to make the changes if the submitted form data is valid.
	if ($Submit_Create && count($FormErrors) == 0) {
		
		if ($Form_CREATEADMIN_USERNAME != "") {
			$result = AddUser($Form_CREATEADMIN_USERNAME, $Form_CREATEADMIN_PASSWORD);
			if ($result === false) {
					$FormErrors[count($FormErrors)] = "The 'Main Admin Username' you entered already exists. Please remove the user from the <codevtcal_user</code> table or enter a different username.";
			}
			elseif (is_string($result)) {
					$FormErrors[count($FormErrors)] = "An error was encountered while creating the main admin account <code>" . htmlentities($Form_CREATEADMIN_USERNAME) . "</code>: <code>" . htmlentities($result) . "</code>";
			}
		}
		
		// Only continue if there are no new errors.
		if (count($FormErrors) == 0) {
			for ($i = 0; $i < count($AccountList); $i++) {
				if (is_string($result = AddMainAdmin($AccountList[$i]))) {
						$FormErrors[count($FormErrors)] = "An error was encountered while granting main admin access to <code>" . htmlentities($AccountList[$i]) . "</code>: <code>" . htmlentities($result) . "</code>";
				}
			}
		}
		
		if (count($FormErrors) == 0) {
		echo '<blockquote><table border="0" cellpadding="0" cellspacing="0" border="0"><tr>';
		echo '<tr><td style="padding-right: 8px;"><img src="success32.png" class="png" width="32" height="32" alt=""/></td><td>The main admin accounts were successfully added.</td></tr>';
		echo '</table></blockquote>';
		}
	}
	
	// Otherwise, show the form to enter the information about the main admins.
	if (!$Submit_Create || count($FormErrors) > 0) {
		if (count($FormErrors) > 0) {
			echo '<blockquote><table border="0" cellpadding="0" cellspacing="0" border="0"><tr>';
			for ($i = 0; $i < count($FormErrors); $i++) {
				echo '<tr><td style="padding-right: 8px;"><img src="failed32.png" class="png" width="32" height="32" alt=""/></td><td>' . $FormErrors[$i] . '</td></tr>';
			}
			echo '</table></blockquote>';
		}
		?>
	
		<h2>About this Wizard:</h2>
		<blockquote>
			<p>If this is a <b>fresh VTCalendar install</b> you may use this wizard to create main admin accounts.</p>
			<p><b>WARNING:</b> After a main admin has been created or granted access to VTCalendar, you will no longer be able to use this wizard.<br/>
			If you forget the password for the main admin, you will need to manually remove all records from the <code>vtcal_adminuser</code> table and use this wizard again.</p>
			<p>You can create main account admins in two ways:</p>
			<ol>
				<li>Create a local account stored in the database (if you are using Database Authentication).<br/>- and/or -</li>
				<li>Grant access to LDAP or HTTP accounts (if you are using LDAP and/or HTTP Authentication).</li>
			</ol>
		</blockquote>
		
		<form action="createadmin.php" method="POST">
			<input type="hidden" name="DSN" value="<?php echo htmlentities($Form_DSN); ?>"/>
			<p><input type="submit" name="Submit_Create" value="Create Account and/or Grant Access &gt;&gt;"/></p>
			<?php require("createadmin-form.inc.php"); ?>
		</form>
		<?php
	}
}

// Otherwise, output any error messages
else {
	if (count($FormErrors) > 0) {
		echo '<table border="0" cellpadding="0" cellspacing="0" border="0"><tr>';
		for ($i = 0; $i < count($FormErrors); $i++) {
			echo '<tr><td style="padding-right: 8px;"><img src="failed32.png" class="png" width="32" height="32" alt=""/></td><td>' . $FormErrors[$i] . '</td></tr>';
		}
		echo '</table>';
	}
}

// Close the DB (if it is still open).
if (isset($DBCONNECTION) && !is_string($DBCONNECTION)) {
	DBClose();
}

function ProcessMainAdminAccountList($accountlist, &$finallist) {
	global $FormErrors;
	
	$splitLDAPAdmins = split("[\n\r]+", $accountlist);
	for ($i = 0; $i < count($splitLDAPAdmins); $i++) {
		if (trim($splitLDAPAdmins[$i]) != "") {
			if (preg_match(REGEXVALIDUSERID, $splitLDAPAdmins[$i]) == 0) {
				$FormErrors[count($FormErrors)] = "The username '<code>" . htmlentities($splitLDAPAdmins[$i]) . "</code>' must match the User ID Regular Expression.";
			}
			else {
				$finallist[count($finallist)] = $splitLDAPAdmins[$i];
			}
		}
	}
}

?>

</body>
</html>