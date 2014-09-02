<?php

function escapephpstring($string) {
	return str_replace("'", "\\'", str_replace("\\", "\\\\", $string));
}

function ProcessMainAdminAccountList($accountlist, &$finallist) {
	global $Form_REGEXVALIDUSERID, $FormErrors;
	
	$splitLDAPAdmins = split("[\n\r]+", $accountlist);
	for ($i = 0; $i < count($splitLDAPAdmins); $i++) {
		if (trim($splitLDAPAdmins[$i]) != "") {
			if (preg_match($Form_REGEXVALIDUSERID, $splitLDAPAdmins[$i]) == 0) {
				$FormErrors[count($FormErrors)] = "The username '<code>" . htmlentities($splitLDAPAdmins[$i]) . "</code>' must match the User ID Regular Expression.";
			}
			else {
				$finallist[count($finallist)] = $splitLDAPAdmins[$i];
			}
		}
	}
}

/*function AddMainAdmin($username) {
	// Check that the account does not already exist
	$result =& DBQuery("SELECT count(*) as idcount FROM vtcal_adminuser WHERE (id='".sqlescape($username)."')");
	
	// Return an error message if the SELECT failed.
	if (is_string($result)) return "Could not SELECT from the vtcal_adminuser table. If you have not created the DB, you will need to <a href='upgradedb.php'>Install or Upgrade Database (MySQL Only)</a> first.<br/>Error: <code>" . htmlentities($result) . "</code>";
	
	$record =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	if ($record['idcount'] != "0") {
		// Return an error message if the user already exists.
		return "'" . htmlentities($username) . "' is already an admin user.";
		
		// - or -
		
		// Return true since the user already exists.
		//return true;
	}
	
	// Insert the account if it does not exist.
	$result =& DBQuery("INSERT INTO vtcal_adminuser (id) VALUES ('".sqlescape($username)."')");
	
	// Return an error message if the INSERT failed.
	if (is_string($result)) return "Could not assign '" . htmlentities($username) . "' as an admin user.<br/>Error: <code>" . htmlentities($result) . "</code>";
	
	// Return that the user was added successfully.
	return true;
}

function AddUser($username, $password) {
	
	// Check that the account does not already exist
	$result =& DBQuery("SELECT count(*) as idcount FROM vtcal_user WHERE (id='".sqlescape($username)."')");
	
	// Return an error message if the SELECT failed.
	if (is_string($result)) return "Could not SELECT from the vtcal_user table. If you have not created the DB, you will need to <a href='upgradedb.php'>Install or Upgrade Database (MySQL Only)</a> first.<br/>Error: <code>" . htmlentities($result) . "</code>";
	
	$record =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	if ($record['idcount'] != "0") {
		// Return an error message if the user already exists.
		return "The '" . htmlentities($username) . "' account already exists.";
		
		// - or -
		
		// Return true since the user already exists.
		//return true;
	}
	
	// Insert the account if it does not exist.
	$result =& DBQuery("INSERT INTO vtcal_user (id, password, email) VALUES ('".sqlescape($username)."','".sqlescape(crypt($password))."','')");
	
	// Return an error message if the INSERT failed.
	if (is_string($result)) return "Could not create the '" . htmlentities($username) . "' account.<br/>Error: <code>" . htmlentities($result) . "</code>";
	
	// Return that the user was added successfully.
	return true;
}*/

?>