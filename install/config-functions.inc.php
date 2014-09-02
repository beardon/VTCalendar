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

?>