<?php
// =====================================
// Config Validation
// =====================================

// Check for an LDAP function if AUTH_LDAP is true.
if (AUTH_LDAP && !function_exists("ldap_connect")) {
	echo "PHP LDAP does not seem to be installed or configured. Make sure the extension is included in your php.ini file.";
	exit();
}

// Make sure the HTTP auth URL is specified if AUTH_HTTP is true.
if (AUTH_HTTP && (!defined("AUTH_HTTP_URL") || AUTH_HTTP_URL == "")) {
	echo "You must set AUTH_HTTP_URL if AUTH_HTTP is set to true.";
	exit();
}

// Check that the required LDAP settings were set if AUTH_LDAP is true.
if (AUTH_LDAP && (!defined("LDAP_HOST") || LDAP_HOST == "" || !defined("LDAP_USERFIELD") || LDAP_USERFIELD == "" || !defined("LDAP_BASE_DN") || LDAP_BASE_DN == "")) {
	echo "You must set LDAP_HOST, LDAP_USERFIELD and LDAP_BASE_DN if AUTH_LDAP is set to true.";
	exit();
}

if (!defined("BASEURL") || substr(BASEURL, -1) != "/") {
	echo "You must set BASEURL and it MUST end with a slash ('/').";
	exit();
}

if (substr(SECUREBASEURL, -1) != "/") {
	echo "SECUREBASEURL MUST end with a slash ('/').";
	exit();
}
?>